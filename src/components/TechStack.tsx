"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";
import { techStack } from "@/data/resume";

const categoryKeys = ["backend", "frontend", "frameworks", "databases", "cloud"] as const;

export default function TechStack() {
  const t = useTranslations("techStack");

  return (
    <AnimatedSection id="tech-stack" className="px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <h2 className="mb-12 text-3xl font-bold">
          <span className="text-primary">#</span> {t("title")}
        </h2>

        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {categoryKeys.map((cat) => (
            <div
              key={cat}
              className="rounded-xl border border-[var(--card-border)] bg-[var(--card-bg)] p-6"
            >
              <h3 className="mb-4 text-lg font-semibold text-primary">
                {t(cat)}
              </h3>
              <div className="flex flex-wrap gap-2">
                {techStack[cat].map((tech) => (
                  <span
                    key={tech}
                    className="rounded-lg border border-[var(--card-border)] bg-[var(--bg)] px-3 py-1.5 text-sm font-medium"
                  >
                    {tech}
                  </span>
                ))}
              </div>
            </div>
          ))}
        </div>
      </div>
    </AnimatedSection>
  );
}
