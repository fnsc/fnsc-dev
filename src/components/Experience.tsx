"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";
import { jobKeys } from "@/data/resume";

export default function Experience() {
  const t = useTranslations("experience");

  return (
    <AnimatedSection id="experience" className="bg-[var(--bg-secondary)] px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <h2 className="mb-12 text-3xl font-bold">
          <span className="text-primary">#</span> {t("title")}
        </h2>

        <div className="relative space-y-8 pl-8 before:absolute before:left-3 before:top-2 before:h-[calc(100%-1rem)] before:w-0.5 before:bg-primary/30">
          {jobKeys.map((key) => (
            <div key={key} className="relative">
              <div className="absolute -left-8 top-2 h-3 w-3 rounded-full border-2 border-primary bg-[var(--bg)]" />
              <div className="rounded-xl border border-[var(--card-border)] bg-[var(--card-bg)] p-6">
                <div className="mb-1 flex flex-wrap items-center justify-between gap-2">
                  <h3 className="text-xl font-semibold">
                    {t(`jobs.${key}.role`)}
                  </h3>
                  <span className="rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary">
                    {t(`jobs.${key}.period`)}
                  </span>
                </div>
                <p className="mb-3 font-medium text-primary">
                  {t(`jobs.${key}.company`)}
                </p>
                <p className="mb-4 text-sm leading-relaxed text-[var(--fg-secondary)]">
                  {t(`jobs.${key}.description`)}
                </p>
                <div className="flex flex-wrap gap-2">
                  {t(`jobs.${key}.tech`)
                    .split(", ")
                    .map((tech) => (
                      <span
                        key={tech}
                        className="rounded-md bg-primary/10 px-2 py-1 text-xs font-medium text-primary"
                      >
                        {tech}
                      </span>
                    ))}
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </AnimatedSection>
  );
}
