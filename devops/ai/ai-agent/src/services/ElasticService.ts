import { Client } from '@elastic/elasticsearch';

/**
 * Integration with Elasticsearch
 */
export class ElasticService {
  private client: Client;

  constructor() {
    this.client = new Client({
      node: process.env.ELASTICSEARCH_URL || 'http://elasticsearch:9200'
    });
  }

  /**
   * Fetch data from Elasticsearch
   */
  public async fetchLogsContext(keyword: string): Promise<string> {
    try {
      const searchResult = await this.client.search({
        index: 'logs-*',
        size: 5,
        query: { match: { message: keyword } }
      });

      const hits = searchResult.hits.hits;
      if (!hits.length) return "No extra context found in DB.";

      return JSON.stringify(hits.map(h => (h._source as any)?.message));
    } catch (error: any) {
      console.error('[Elasticsearch Error]:', error.message);
      return `ES lookup failed: ${error.message}`;
    }
  }
}
