import { routing } from "@/i18n/routing";
import {
  contactInfo,
  jobKeys,
  techStack,
  categoryKeys,
  openSourceKeys,
  openSourceLinks,
  personalProjectsKeys,
  personalProjectsLinks,
  certKeys,
  softSkillKeys,
  languageKeys,
} from "@/data/resume";
import type { PdfResumeData } from "@/types/pdf";

export async function buildPdfResumeData(
  locale: string,
): Promise<PdfResumeData> {
  if (!routing.locales.includes(locale as (typeof routing.locales)[number])) {
    throw new Error(`Invalid locale: ${locale}`);
  }

  const messages = (await import(`../../messages/${locale}.json`)).default;

  const jobs = jobKeys.map((key) => ({
    role: messages.experience.jobs[key].role,
    company: messages.experience.jobs[key].company,
    period: messages.experience.jobs[key].period,
    description: messages.experience.jobs[key].description,
    tech: messages.experience.jobs[key].tech,
  }));

  const categoryLabels: Record<string, string> = {};
  for (const cat of categoryKeys) {
    categoryLabels[cat] = messages.pdf[cat] ?? messages.techStack[cat];
  }

  const certifications = certKeys.map((key) => messages.education.certs[key]);

  const openSource = openSourceKeys.map((key) => ({
    name: messages.openSource.projects[key].name,
    role: messages.openSource.projects[key].role,
    description: messages.openSource.projects[key].description,
    url: openSourceLinks[key],
  }));

  const personalProjects = personalProjectsKeys.map((key) => ({
    name: messages.personalProjects.projects[key].name,
    role: messages.personalProjects.projects[key].role,
    description: messages.personalProjects.projects[key].description,
    url: personalProjectsLinks[key],
  }));

  const softSkills = softSkillKeys.map(
    (key) => messages.softSkills.skills[key].name,
  );

  const languages = languageKeys.map(
    (key) => messages.languages.items[key],
  );

  const education = {
    institution: messages.education.degree.institution,
    program: messages.education.degree.program,
    field: messages.education.degree.field,
    period: messages.education.degree.period,
  };

  return {
    name: messages.hero.resumeName,
    title: messages.hero.title,
    summary: messages.about.description,
    contact: contactInfo,
    jobs,
    techStack,
    categoryLabels,
    education,
    certifications,
    openSource,
    personalProjects,
    softSkills,
    languages,
    labels: {
      summary: messages.pdf.summary,
      experience: messages.experience.title,
      skills: messages.pdf.skills,
      education: messages.education.education,
      certificates: messages.education.certificates,
      openSource: messages.openSource.title,
      personalProjects: messages.personalProjects.title,
      softSkills: messages.softSkills.title,
      languages: messages.languages.title,
      technologies: messages.experience.technologies,
      present: messages.experience.present,
    },
  };
}
