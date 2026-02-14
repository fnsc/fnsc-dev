"use client";

import { useTranslations } from "next-intl";

export default function Footer() {
  const t = useTranslations("footer");
  const year = new Date().getFullYear();

  return (
    <footer className="border-t border-[var(--card-border)] px-4 py-8">
      <div className="mx-auto flex max-w-4xl flex-col items-center justify-between gap-2 text-sm text-[var(--fg-secondary)] sm:flex-row">
        <p>&copy; {year} Gabriel Fonseca. {t("rights")}</p>
        <p>{t("builtWith")}</p>
      </div>
    </footer>
  );
}
