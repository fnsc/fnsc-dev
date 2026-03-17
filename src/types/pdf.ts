import type { ContactInfo, TechStack } from "@/types/resume";

export interface PdfJob {
  role: string;
  company: string;
  period: string;
  description: string;
  tech: string;
}

export interface PdfProject {
  name: string;
  role: string;
  description: string;
  url: string;
}

export interface PdfEducation {
  institution: string;
  program: string;
  field: string;
  period: string;
}

export interface PdfLabels {
  summary: string;
  experience: string;
  skills: string;
  education: string;
  certificates: string;
  openSource: string;
  personalProjects: string;
  softSkills: string;
  languages: string;
  technologies: string;
  present: string;
}

export interface PdfResumeData {
  name: string;
  title: string;
  summary: string;
  contact: ContactInfo;
  jobs: PdfJob[];
  techStack: TechStack;
  categoryLabels: Record<string, string>;
  education: PdfEducation;
  certifications: string[];
  openSource: PdfProject[];
  personalProjects: PdfProject[];
  softSkills: string[];
  languages: string[];
  labels: PdfLabels;
}
