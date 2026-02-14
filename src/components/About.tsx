"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";

export default function About() {
  const t = useTranslations("about");

  return (
    <AnimatedSection id="about" className="px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <h2 className="mb-8 text-3xl font-bold">
          <span className="text-primary">#</span> {t("title")}
        </h2>
        <p className="text-lg leading-relaxed text-[var(--fg-secondary)]">
          {t("description")}
        </p>
      </div>
    </AnimatedSection>
  );
}
