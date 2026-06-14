/**
 * Safety auditing and log sanitization
 */
export class GuardrailsService {
  private blockedKeywords = ["rm", "drop", "delete", "shutdown"];

  /**
   * Sanitizes input data
   */
  public sanitizeInput(input: string): string {
    let sanitized = input;
    sanitized = sanitized.replace(/(bearer\s)[a-zA-Z0-9_\-\.]+/gi, "$1[MASKED]");
    sanitized = sanitized.replace(/(password=|passwd=)[a-zA-Z0-9_\-\.]+/gi, "$1[MASKED]");
    return sanitized;
  }

  /**
   * Validates LLM response
   */
  public validateOutput(output: string): string {
    const containsMaliciousContent = this.blockedKeywords.some((keyword) =>
      output.toLowerCase().includes(keyword)
    );

    if (containsMaliciousContent) {
      throw new Error("Guardrails Triggered: LLM generated a potentially destructive command.");
    }

    return output;
  }
}
