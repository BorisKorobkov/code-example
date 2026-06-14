/**
 * Integration with MLflow
 */
export class MLflowService {
  private mlflowUrl: string;

  constructor() {
    this.mlflowUrl = process.env.MLFLOW_TRACKING_URL || 'http://mlflow:5000';
  }

  /**
   * Send data to MLflow
   */
  public async logIncidentRun(runName: string, params: Record<string, string>): Promise<void> {
    try {
      const runResponse = await fetch(`${this.mlflowUrl}/api/2.0/mlflow/runs/create`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ experiment_id: "0", run_name: runName })
      });
      
      const { run } = await runResponse.json() as any;
      const runId = run.info.run_id;

      for (const [key, value] of Object.entries(params)) {
        await fetch(`${this.mlflowUrl}/api/2.0/mlflow/runs/log-parameter`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ run_id: runId, key, value: String(value) })
        });
      }

      console.log(`[MLflow] Telemetry successfully saved. Run ID: ${runId}`);
    } catch (error: any) {
      console.error('[MLflow Error] Failed to send telemetry:', error.message);
    }
  }
}
