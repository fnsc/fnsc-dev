"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";
import SectionHeading from "./ui/SectionHeading";
import Card from "./ui/Card";
import { softSkillKeys } from "@/data/resume";

export default function SoftSkills() {
  const t = useTranslations("softSkills");

  return (
    <AnimatedSection id="soft-skills" className="bg-bg-secondary px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <SectionHeading>{t("title")}</SectionHeading>

        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {softSkillKeys.map((key) => (
            <Card key={key}>
              <h3 className="mb-2 text-base font-semibold text-primary">
                {t(`skills.${key}.name`)}
              </h3>
              <p className="text-sm leading-relaxed text-fg-secondary">
                {t(`skills.${key}.description`)}
              </p>
            </Card>
          ))}
        </div>
      </div>
    </AnimatedSection>
  );
}
