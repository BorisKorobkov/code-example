import { Annotation } from "@langchain/langgraph";

export interface IAgentState {
  inputLog: string;
  esContext: string;
  aiAnalysis: string;
}

/**
 * LangGraph fields
 */
export const AgentStateAnnotation = Annotation.Root({
  inputLog: Annotation<string>({ reducer: (x, y) => y, default: () => "" }),
  esContext: Annotation<string>({ reducer: (x, y) => y, default: () => "" }),
  aiAnalysis: Annotation<string>({ reducer: (x, y) => y, default: () => "" }),
});
