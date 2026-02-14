import { getTranslations } from "next-intl/server";
import AnimatedSection from "./AnimatedSection";
import SectionHeading from "./ui/SectionHeading";

export default async function About() {
  const t = await getTranslations("about");

  return (
    <AnimatedSection id="about" className="px-4 py-20">
      <div className="mx-auto max-w-4xl">
        <SectionHeading className="mb-8">{t("title")}</SectionHeading>
        <p className="text-lg leading-relaxed text-fg-secondary">
          {t("description")}
        </p>
      </div>
    </AnimatedSection>
  );
}
