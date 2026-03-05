"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";
import SectionHeading from "./ui/SectionHeading";
import Badge from "./ui/Badge";
import { personalProjectsKeys } from "@/data/resume";

export default function PersonalProject() {
  const t = useTranslations("personalProjects");

  return (
    <AnimatedSection id="personal-projects" className="px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <SectionHeading>{t("title")}</SectionHeading>

        <div className="grid gap-6 sm:grid-cols-2">
          {personalProjectsKeys.map((key) => {
            const role = t(`projects.${key}.role`);
            const isOwner = role === "owner";

            return (
              <a
                key={key}
                href="#personal-projects" // TODO: add real links
                target="_blank"
                rel="noopener noreferrer"
                className="group flex items-start gap-4 rounded-xl border border-card-border bg-card-bg p-6 transition-colors hover:border-primary"
              >
                <div className="flex-1">
                  <h3 className="mb-2 text-lg font-semibold group-hover:text-primary">
                    {t(`projects.${key}.name`)}
                  </h3>
                  <Badge variant={isOwner ? "primary" : "subtle"}>
                    {isOwner ? t("owner") : t("contributor")}
                  </Badge>
                </div>
              </a>
            );
          })}
        </div>
      </div>
    </AnimatedSection>
  );
}
