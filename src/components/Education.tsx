"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";
import { certKeys } from "@/data/resume";

export default function Education() {
  const t = useTranslations("education");

  return (
    <AnimatedSection id="education" className="px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <h2 className="mb-12 text-3xl font-bold">
          <span className="text-primary">#</span> {t("title")}
        </h2>

        <div className="grid gap-8 md:grid-cols-2">
          <div className="rounded-xl border border-[var(--card-border)] bg-[var(--card-bg)] p-6">
            <h3 className="mb-4 text-lg font-semibold text-primary">
              {t("education")}
            </h3>
            <h4 className="mb-1 text-base font-semibold">
              {t("degree.program")}
            </h4>
            <p className="mb-1 text-sm text-[var(--fg-secondary)]">
              {t("degree.field")}
            </p>
            <p className="mb-2 text-sm font-medium">
              {t("degree.institution")}
            </p>
            <p className="text-xs text-primary">{t("degree.period")}</p>
          </div>

          <div className="rounded-xl border border-[var(--card-border)] bg-[var(--card-bg)] p-6">
            <h3 className="mb-4 text-lg font-semibold text-primary">
              {t("certificates")}
            </h3>
            <ul className="space-y-3">
              {certKeys.map((key) => (
                <li key={key} className="flex items-start gap-2 text-sm">
                  <svg
                    className="mt-0.5 h-4 w-4 shrink-0 text-primary"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    strokeWidth={2}
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>
                  {t(`certs.${key}`)}
                </li>
              ))}
            </ul>
          </div>
        </div>
      </div>
    </AnimatedSection>
  );
}
