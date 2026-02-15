import type { ContactInfo, TechStack } from "@/types/resume";

export interface PdfJob {
  role: string;
  company: string;
  period: string;
  description: string;
  tech: string;
}

export interface PdfOpenSource {
  name: string;
  role: string;
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
  openSource: PdfOpenSource[];
  labels: PdfLabels;
}
