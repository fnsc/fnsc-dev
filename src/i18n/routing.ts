import { defineRouting } from "next-intl/routing";

export const routing = defineRouting({
  locales: ["en-CA", "fr-CA", "pt-BR"],
  defaultLocale: "en-CA",
});
