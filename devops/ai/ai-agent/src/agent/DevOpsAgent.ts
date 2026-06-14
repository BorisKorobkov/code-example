import { StateGraph, START, END } from "@langchain/langgraph";
import { ChatOllama } from "@langchain/ollama";
import { ChatPromptTemplate } from "@langchain/core/prompts";
import { ElasticService } from "../services/ElasticService.js";
import { GuardrailsService } from "../services/GuardrailsService.js";
import { AgentStateAnnotation, IAgentState } from "./AgentState.js";

/**
 * DevOps agent
 */
export class DevOpsAgent {
  private compiledGraph;
  private model: ChatOllama;

  constructor(
    private elasticService: ElasticService,
    private guardrailsService: GuardrailsService
  ) {
    this.model = new ChatOllama({
      baseUrl: process.env.OLLAMA_HOST || "http://ollama:11434",
      model: "llama3",
      temperature: 0,
    });
    
    this.compiledGraph = this.buildGraph();
  }

  /**
   * Get data from Elasticsearch
   */
  private async fetchContextNode(state: IAgentState) {
    const cleanLog = this.guardrailsService.sanitizeInput(state.inputLog);
    const context = await this.elasticService.fetchLogsContext(cleanLog);

    return { esContext: context };
  }

  /**
   * Ask Ollama
   */
  private async callOllamaNode(state: IAgentState) {
    const promptTemplate = ChatPromptTemplate.fromMessages([
      [
        "system",
        "You are an expert DevOps engineer. Analyze the production logs and provide a short root-cause analysis and a safe remediation command."
      ]
    ]);
    const chain = promptTemplate.pipe(this.model);
    const response = await chain.invoke({
      inputLog: state.inputLog,
      esContext: state.esContext
    }) as { content: string };
    const rawOutput = response.content;
    const safeOutput = this.guardrailsService.validateOutput(rawOutput);

    return { aiAnalysis: safeOutput };
  }

  /**
   * Build graph using LangGraph
   */
  private buildGraph() {
    return new StateGraph(AgentStateAnnotation)
      .addNode("fetch_context", this.fetchContextNode.bind(this))
      .addNode("call_ollama", this.callOllamaNode.bind(this))
      .addEdge(START, "fetch_context")
      .addEdge("fetch_context", "call_ollama")
      .addEdge("call_ollama", END)
      .compile();
  }

  /**
   * Trigger agent graph pipeline
   */
  public async execute(triggerLog: string): Promise<IAgentState> {
    return await this.compiledGraph.invoke({ inputLog: triggerLog });
  }
}
