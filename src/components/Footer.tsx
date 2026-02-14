import { getTranslations } from "next-intl/server";

export default async function Footer() {
  const t = await getTranslations("footer");
  const year = new Date().getFullYear();

  return (
    <footer className="border-t border-card-border px-4 py-8">
      <div className="mx-auto flex max-w-4xl flex-col items-center justify-between gap-2 text-sm text-fg-secondary sm:flex-row">
        <p>&copy; {year} Gabriel Fonseca. {t("rights")}</p>
        <p>{t("builtWith")}</p>
      </div>
    </footer>
  );
}
