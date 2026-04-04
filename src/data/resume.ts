import type {
  ContactInfo,
  JobKey,
  TechStack,
  TechCategory,
  OpenSourceKey,
  PersonalProjectsKey,
  PersonalProjectMeta,
  CertKey,
  SoftSkillKey,
  LanguageKey,
} from "@/types/resume";

export const contactInfo: ContactInfo = {
  email: "gabrieldfnsc@gmail.com",
  phone: "+1 (604) 417-4066",
  address: "823 Carnarvon Street, New Westminster, BC",
  location: "New Westminster, BC",
  github: "https://github.com/fnsc",
  linkedin: "https://www.linkedin.com/in/fnsc/",
  website: "https://fnsc.dev",
};

export const jobKeys: readonly JobKey[] = [
  "loopio",
  "netcoins",
  "m56",
  "leroy",
  "masp",
  "dvm",
];

export const techStack: TechStack = {
  backend: ["PHP", "NodeJS", "Go", "TypeScript", "C#", "Swift"],
  frontend: ["HTML5", "CSS", "JavaScript", "TypeScript"],
  frameworks: ["Laravel", "Symfony", "ExpressJs", "VueJs", "ReactJs", "DotNet"],
  testing: ["PHPUnit", "TDD", "Docker", "GitHub Actions", "Jenkins", "Grafana", "Datadog"],
  databases: ["MySQL", "PostgreSQL", "MongoDB", "Redis", "Elasticsearch"],
  cloud: ["AWS", "GCP", "Azure"],
  integrations: ["Apache Kafka", "Stripe", "Shopify", "Segment", "RevenueCat"],
};

export const categoryKeys: readonly TechCategory[] = [
  "backend",
  "frontend",
  "frameworks",
  "testing",
  "databases",
  "cloud",
  "integrations",
];

export const openSourceKeys: readonly OpenSourceKey[] = [
  "laravelGoogleDrive",
  "cpfCnpj",
  "metamorphosis",
  "mongolid",
];

export const personalProjectsKeys: readonly PersonalProjectsKey[] = [
  "luvia",
  "defuseGrid",
];

export const openSourceLinks: Record<OpenSourceKey, string> = {
  laravelGoogleDrive: "https://github.com/fnsc/laravel-google-drive",
  cpfCnpj: "https://github.com/fnsc/cpf-cnpj-validation",
  metamorphosis: "https://github.com/leroy-merlin-br/metamorphosis",
  mongolid: "https://github.com/leroy-merlin-br/mongolid",
};

export const personalProjectsMeta: Record<PersonalProjectsKey, PersonalProjectMeta> = {
  luvia: {
    url: "https://testflight.apple.com/join/Qhg7xcyK",
    platform: "ios",
  },
  defuseGrid: {
    url: "https://apps.apple.com/us/app/defuse-grid/id6760957731",
    platform: "ios",
  },
};

export const certKeys: readonly CertKey[] = ["cspo", "kanban", "devops", "wes"];

export const softSkillKeys: readonly SoftSkillKey[] = [
  "technicalLeadership",
  "mentorship",
  "crossFunctionalCollab",
  "codeReview",
  "agile",
  "problemSolving",
];

export const languageKeys: readonly LanguageKey[] = ["portuguese", "english"];
