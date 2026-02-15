import { describe, it, expect } from "vitest";
import { parseTechString } from "@/lib/format";

describe("parseTechString", () => {
  it("splits comma-separated technologies", () => {
    expect(parseTechString("PHP, Node.js, Go")).toEqual([
      "PHP",
      "Node.js",
      "Go",
    ]);
  });

  it("returns a single-item array for one technology", () => {
    expect(parseTechString("Laravel")).toEqual(["Laravel"]);
  });

  it("returns an empty array for an empty string", () => {
    expect(parseTechString("")).toEqual([]);
  });
});
