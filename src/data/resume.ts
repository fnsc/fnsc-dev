import type {
  ContactInfo,
  JobKey,
  TechStack,
  TechCategory,
  OpenSourceKey,
  CertKey,
} from "@/types/resume";

export const contactInfo: ContactInfo = {
  email: "gabrieldfnsc@gmail.com",
  phone: "+1 (604) 417-4066",
  address: "823 Carnarvon Street",
  github: "https://github.com/fnsc",
  linkedin: "https://www.linkedin.com/in/fnsc/",
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
  backend: ["PHP", "NodeJS", "Go", "TypeScript"],
  frontend: ["HTML5", "CSS", "JavaScript", "TypeScript"],
  frameworks: ["Laravel", "Symfony", "PHPUnit", "ExpressJs", "VueJs", "ReactJs"],
  databases: ["MySQL", "PostgreSQL", "MongoDB"],
  cloud: ["AWS", "GCP", "Azure"],
};

export const categoryKeys: readonly TechCategory[] = [
  "backend",
  "frontend",
  "frameworks",
  "databases",
  "cloud",
];

export const openSourceKeys: readonly OpenSourceKey[] = [
  "laravelGoogleDrive",
  "cpfCnpj",
  "metamorphosis",
  "mongolid",
];

export const openSourceLinks: Record<OpenSourceKey, string> = {
  laravelGoogleDrive: "https://github.com/fnsc/laravel-google-drive",
  cpfCnpj: "https://github.com/fnsc/cpf-cnpj-validation",
  metamorphosis: "https://github.com/leroy-merlin-br/metamorphosis",
  mongolid: "https://github.com/leroy-merlin-br/mongolid",
};

export const certKeys: readonly CertKey[] = ["cspo", "kanban", "devops", "wes"];
