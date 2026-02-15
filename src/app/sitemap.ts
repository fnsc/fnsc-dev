import type { MetadataRoute } from "next";
import { routing } from "@/i18n/routing";
import { getPostSlugs } from "@/lib/blog";

export default function sitemap(): MetadataRoute.Sitemap {
  const entries: MetadataRoute.Sitemap = routing.locales.map((locale) => ({
    url: `https://fnsc.dev/${locale}`,
    lastModified: new Date(),
    changeFrequency: "monthly",
    priority: locale === routing.defaultLocale ? 1 : 0.8,
  }));

  for (const locale of routing.locales) {
    entries.push({
      url: `https://fnsc.dev/${locale}/blog`,
      lastModified: new Date(),
      changeFrequency: "weekly",
      priority: 0.7,
    });

    for (const slug of getPostSlugs(locale)) {
      entries.push({
        url: `https://fnsc.dev/${locale}/blog/${slug}`,
        lastModified: new Date(),
        changeFrequency: "monthly",
        priority: 0.6,
      });
    }
  }

  return entries;
}
