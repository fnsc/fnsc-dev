import { describe, it, expect } from "vitest";
import { GET } from "@/app/api/resume/[locale]/route";

function makeRequest(locale: string) {
  const request = new Request(`http://localhost/api/resume/${locale}`);
  const params = Promise.resolve({ locale });
  return GET(request, { params });
}

describe("GET /api/resume/[locale]", () => {
  it("returns 400 for invalid locale", async () => {
    const response = await makeRequest("xx-XX");

    expect(response.status).toBe(400);
    const body = await response.json();
    expect(body.error).toBe("Invalid locale");
  });

  it("returns a PDF for en-CA", async () => {
    const response = await makeRequest("en-CA");

    expect(response.status).toBe(200);
    expect(response.headers.get("Content-Type")).toBe("application/pdf");
  });

  it("sets Content-Disposition with filename", async () => {
    const response = await makeRequest("en-CA");
    const disposition = response.headers.get("Content-Disposition");

    expect(disposition).toMatch(/attachment; filename="gabriel-fonseca_.+\.pdf"/);
  });

  it("sets cache headers", async () => {
    const response = await makeRequest("en-CA");
    const cache = response.headers.get("Cache-Control");

    expect(cache).toContain("s-maxage=86400");
  });

  it("returns a valid PDF buffer", async () => {
    const response = await makeRequest("en-CA");
    const buffer = await response.arrayBuffer();

    expect(buffer.byteLength).toBeGreaterThan(0);
    // PDF files start with %PDF
    const header = new TextDecoder().decode(buffer.slice(0, 5));
    expect(header).toBe("%PDF-");
  });

  it("generates PDFs for all locales", async () => {
    for (const locale of ["en-CA", "fr-CA", "pt-BR"]) {
      const response = await makeRequest(locale);
      expect(response.status).toBe(200);
      expect(response.headers.get("Content-Type")).toBe("application/pdf");
    }
  });
});
