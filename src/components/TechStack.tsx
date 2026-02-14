"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";
import SectionHeading from "./ui/SectionHeading";
import Card from "./ui/Card";
import { techStack, categoryKeys } from "@/data/resume";

export default function TechStack() {
  const t = useTranslations("techStack");

  return (
    <AnimatedSection id="tech-stack" className="px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <SectionHeading>{t("title")}</SectionHeading>

        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {categoryKeys.map((cat) => (
            <Card key={cat}>
              <h3 className="mb-4 text-lg font-semibold text-primary">
                {t(cat)}
              </h3>
              <div className="flex flex-wrap gap-2">
                {techStack[cat].map((tech) => (
                  <span
                    key={tech}
                    className="rounded-lg border border-card-border bg-bg px-3 py-1.5 text-sm font-medium"
                  >
                    {tech}
                  </span>
                ))}
              </div>
            </Card>
          ))}
        </div>
      </div>
    </AnimatedSection>
  );
}
