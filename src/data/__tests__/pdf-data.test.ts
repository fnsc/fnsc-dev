import { describe, it, expect } from "vitest";
import { buildPdfResumeData } from "@/data/pdf-data";
import { contactInfo, jobKeys, openSourceKeys, certKeys } from "@/data/resume";

describe("buildPdfResumeData", () => {
  it("throws on invalid locale", async () => {
    await expect(buildPdfResumeData("xx-XX")).rejects.toThrow("Invalid locale");
  });

  it("returns complete data for en-CA", async () => {
    const data = await buildPdfResumeData("en-CA");

    expect(data.name).toBe("Gabriel Fonseca");
    expect(data.title).toBe("Software Engineer");
    expect(data.contact).toEqual(contactInfo);
    expect(data.summary).toBeTruthy();
  });

  it("maps all jobs from resume.ts", async () => {
    const data = await buildPdfResumeData("en-CA");

    expect(data.jobs).toHaveLength(jobKeys.length);
    for (const job of data.jobs) {
      expect(job.role).toBeTruthy();
      expect(job.company).toBeTruthy();
      expect(job.period).toBeTruthy();
      expect(job.description).toBeTruthy();
      expect(job.tech).toBeTruthy();
    }
  });

  it("maps all open source projects", async () => {
    const data = await buildPdfResumeData("en-CA");

    expect(data.openSource).toHaveLength(openSourceKeys.length);
    for (const project of data.openSource) {
      expect(project.name).toBeTruthy();
      expect(project.role).toBeTruthy();
      expect(project.description).toBeTruthy();
      expect(project.url).toMatch(/^https:\/\/github\.com\//);
    }
  });

  it("maps all certifications", async () => {
    const data = await buildPdfResumeData("en-CA");

    expect(data.certifications).toHaveLength(certKeys.length);
    for (const cert of data.certifications) {
      expect(cert).toBeTruthy();
    }
  });

  it("uses PDF-specific labels instead of website labels", async () => {
    const data = await buildPdfResumeData("en-CA");

    expect(data.labels.summary).toBe("Summary");
    expect(data.labels.skills).toBe("Technical Skills");
  });

  it("includes testing category label from PDF overrides", async () => {
    const data = await buildPdfResumeData("en-CA");

    expect(data.categoryLabels.testing).toBe("Testing & Tools");
  });

  it("returns localized content for each locale", async () => {
    const enData = await buildPdfResumeData("en-CA");
    const frData = await buildPdfResumeData("fr-CA");
    const ptData = await buildPdfResumeData("pt-BR");

    expect(enData.title).toBe("Software Engineer");
    expect(frData.title).toBe("Ingénieur logiciel");
    expect(ptData.title).toBe("Engenheiro de Software");

    expect(enData.labels.summary).toBe("Summary");
    expect(frData.labels.summary).toBe("Résumé professionnel");
    expect(ptData.labels.summary).toBe("Resumo profissional");
  });

  it("includes education data", async () => {
    const data = await buildPdfResumeData("en-CA");

    expect(data.education.institution).toBeTruthy();
    expect(data.education.program).toBeTruthy();
    expect(data.education.field).toBeTruthy();
    expect(data.education.period).toBeTruthy();
  });
});
