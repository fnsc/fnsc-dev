"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";
import SectionHeading from "./ui/SectionHeading";
import Card from "./ui/Card";
import Badge from "./ui/Badge";
import { jobKeys } from "@/data/resume";
import { parseTechString } from "@/lib/format";

export default function Experience() {
  const t = useTranslations("experience");

  return (
    <AnimatedSection id="experience" className="bg-bg-secondary px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <SectionHeading>{t("title")}</SectionHeading>

        <div className="relative space-y-8 pl-8 before:absolute before:left-3 before:top-2 before:h-[calc(100%-1rem)] before:w-0.5 before:bg-primary/30">
          {jobKeys.map((key) => (
            <div key={key} className="relative">
              <div className="absolute -left-8 top-2 h-3 w-3 rounded-full border-2 border-primary bg-bg" />
              <Card>
                <div className="mb-1 flex flex-wrap items-center justify-between gap-2">
                  <h3 className="text-xl font-semibold">
                    {t(`jobs.${key}.role`)}
                  </h3>
                  <Badge>{t(`jobs.${key}.period`)}</Badge>
                </div>
                <p className="mb-3 font-medium text-primary">
                  {t(`jobs.${key}.company`)}
                </p>
                <p className="mb-4 text-sm leading-relaxed text-fg-secondary">
                  {t(`jobs.${key}.description`)}
                </p>
                <div className="flex flex-wrap gap-2">
                  {parseTechString(t(`jobs.${key}.tech`)).map((tech) => (
                    <span
                      key={tech}
                      className="rounded-md bg-primary/10 px-2 py-1 text-xs font-medium text-primary"
                    >
                      {tech}
                    </span>
                  ))}
                </div>
              </Card>
            </div>
          ))}
        </div>
      </div>
    </AnimatedSection>
  );
}
