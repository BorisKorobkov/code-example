import express, { Request, Response } from 'express';
import { ElasticService } from './services/ElasticService.js';
import { MLflowService } from './services/MLflowService.js';
import { GuardrailsService } from './services/GuardrailsService.js';
import { DevOpsAgent } from './agent/DevOpsAgent.js';

const app = express();
app.use(express.json());

const elasticService = new ElasticService();
const mlflowService = new MLflowService();
const guardrailsService = new GuardrailsService();
const devOpsAgent = new DevOpsAgent(elasticService, guardrailsService);

/**
 * RCA (root-cause analysis)
 */
app.post('/analyze', async (req: Request, res: Response): Promise<void> => {
  try {
    const triggerLog: string = req.body.log || "Nginx 502 Bad Gateway";

    // Step 1. Process the incident through the LangGraph runtime
    const agentResult = await devOpsAgent.execute(triggerLog);

    // Step 2. Dispatch execution metrics to MLflow for auditing
    await mlflowService.logIncidentRun("DevOps_TS_Agent_Analysis", {
      incoming_error: triggerLog,
      es_context_extracted: agentResult.esContext,
      ai_output_remediation: agentResult.aiAnalysis
    });

    res.status(200).json({ success: true, data: agentResult });
  } catch (error: any) {
    res.status(500).json({ success: false, error: error.message });
  }
});

/**
 * Healthcheck
 */
app.get('/health', (req: Request, res: Response) => {
  res.status(200).send('OK');
});

const PORT = process.env.PORT || 8000;
app.listen(PORT, () => {
  console.log(`[TypeScript AI Agent] running on port ${PORT}`);
});
