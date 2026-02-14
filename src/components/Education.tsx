import { getTranslations } from "next-intl/server";
import AnimatedSection from "./AnimatedSection";
import SectionHeading from "./ui/SectionHeading";
import Card from "./ui/Card";
import { certKeys } from "@/data/resume";

export default async function Education() {
  const t = await getTranslations("education");

  return (
    <AnimatedSection id="education" className="px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <SectionHeading>{t("title")}</SectionHeading>

        <div className="grid gap-8 md:grid-cols-2">
          <Card>
            <h3 className="mb-4 text-lg font-semibold text-primary">
              {t("education")}
            </h3>
            <h4 className="mb-1 text-base font-semibold">
              {t("degree.program")}
            </h4>
            <p className="mb-1 text-sm text-fg-secondary">
              {t("degree.field")}
            </p>
            <p className="mb-2 text-sm font-medium">
              {t("degree.institution")}
            </p>
            <p className="text-xs text-primary">{t("degree.period")}</p>
          </Card>

          <Card>
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
          </Card>
        </div>
      </div>
    </AnimatedSection>
  );
}
