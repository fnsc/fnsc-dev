"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";
import { openSourceKeys, openSourceLinks } from "@/data/resume";

export default function OpenSource() {
  const t = useTranslations("openSource");

  return (
    <AnimatedSection id="open-source" className="bg-[var(--bg-secondary)] px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <h2 className="mb-12 text-3xl font-bold">
          <span className="text-primary">#</span> {t("title")}
        </h2>

        <div className="grid gap-6 sm:grid-cols-2">
          {openSourceKeys.map((key) => {
            const role = t(`projects.${key}.role`);
            const isOwner = role === "owner";

            return (
              <a
                key={key}
                href={openSourceLinks[key]}
                target="_blank"
                rel="noopener noreferrer"
                className="group flex items-start gap-4 rounded-xl border border-[var(--card-border)] bg-[var(--card-bg)] p-6 transition-colors hover:border-primary"
              >
                <div className="flex-1">
                  <h3 className="mb-2 text-lg font-semibold group-hover:text-primary">
                    {t(`projects.${key}.name`)}
                  </h3>
                  <span
                    className={`inline-block rounded-full px-3 py-1 text-xs font-medium ${
                      isOwner
                        ? "bg-primary/15 text-primary"
                        : "bg-[var(--card-border)] text-[var(--fg-secondary)]"
                    }`}
                  >
                    {isOwner ? t("owner") : t("contributor")}
                  </span>
                </div>
                <svg
                  className="mt-1 h-5 w-5 text-[var(--fg-secondary)] transition-colors group-hover:text-primary"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                </svg>
              </a>
            );
          })}
        </div>
      </div>
    </AnimatedSection>
  );
}
