"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";
import SectionHeading from "./ui/SectionHeading";
import ProjectCard, { badgeVariantForRole } from "./ui/ProjectCard";
import { personalProjectsKeys, personalProjectsMeta } from "@/data/resume";
import type { Platform } from "@/types/resume";
import { ReactNode } from "react";

function AppleIcon() {
  return (
    <svg
      className="mt-1 h-5 w-5 text-fg-secondary transition-colors group-hover:text-primary"
      viewBox="0 0 24 24"
      fill="currentColor"
    >
      <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z" />
    </svg>
  );
}

function iconForPlatform(platform: Platform): ReactNode {
  if (platform === "ios") return <AppleIcon />;
  return null;
}

export default function PersonalProject() {
  const t = useTranslations("personalProjects");

  return (
    <AnimatedSection id="personal-projects" className="px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <SectionHeading>{t("title")}</SectionHeading>

        <div className="grid gap-6 sm:grid-cols-2">
          {personalProjectsKeys.map((key) => {
            const meta = personalProjectsMeta[key];
            const role = t(`projects.${key}.role`);
            const roleLabel = role === "owner" ? t("owner") : t("contributor");

            return (
              <ProjectCard
                key={key}
                href={meta.url}
                name={t(`projects.${key}.name`)}
                roleLabel={roleLabel}
                badgeVariant={badgeVariantForRole(role)}
                icon={iconForPlatform(meta.platform)}
              />
            );
          })}
        </div>
      </div>
    </AnimatedSection>
  );
}
