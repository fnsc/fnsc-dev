export interface ContactInfo {
  email: string;
  phone: string;
  address: string;
  location: string;
  github: string;
  linkedin: string;
  website: string;
}

export type JobKey = "loopio" | "netcoins" | "m56" | "leroy" | "masp" | "dvm";

export interface TechStack {
  backend: string[];
  frontend: string[];
  frameworks: string[];
  testing: string[];
  databases: string[];
  cloud: string[];
}

export type TechCategory = keyof TechStack;

export type OpenSourceKey =
  | "laravelGoogleDrive"
  | "cpfCnpj"
  | "metamorphosis"
  | "mongolid";

export type CertKey = "cspo" | "kanban" | "devops" | "wes";
