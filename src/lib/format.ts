export function parseTechString(tech: string): string[] {
  return tech.split(", ").filter(Boolean);
}
