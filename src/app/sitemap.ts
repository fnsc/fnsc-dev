import type { MetadataRoute } from "next";
import { routing } from "@/i18n/routing";
import { getAllPosts } from "@/lib/blog";

export default async function sitemap(): Promise<MetadataRoute.Sitemap> {
  const entries: MetadataRoute.Sitemap = routing.locales.map((locale) => ({
    url: `https://fnsc.dev/${locale}`,
    lastModified: new Date(),
    changeFrequency: "monthly",
    priority: locale === routing.defaultLocale ? 1 : 0.8,
  }));

  for (const locale of routing.locales) {
    const posts = await getAllPosts(locale);

    entries.push({
      url: `https://fnsc.dev/${locale}/blog`,
      lastModified: posts[0]
        ? new Date(posts[0].frontmatter.date)
        : new Date(),
      changeFrequency: "weekly",
      priority: 0.7,
    });

    for (const post of posts) {
      entries.push({
        url: `https://fnsc.dev/${locale}/blog/${post.slug}`,
        lastModified: new Date(post.frontmatter.date),
        changeFrequency: "monthly",
        priority: 0.6,
      });
    }
  }

  return entries;
}
