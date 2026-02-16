import { ImageResponse } from "next/og";
import { getTranslations } from "next-intl/server";
import { routing } from "@/i18n/routing";
import { getPostBySlug, getPostSlugs } from "@/lib/blog";

export const alt = "Blog post";
export const size = { width: 1200, height: 630 };
export const contentType = "image/png";

export function generateStaticParams() {
  const params: { locale: string; slug: string }[] = [];
  for (const locale of routing.locales) {
    for (const slug of getPostSlugs(locale)) {
      params.push({ locale, slug });
    }
  }
  return params;
}

export default async function OGImage({
  params,
}: {
  params: Promise<{ locale: string; slug: string }>;
}) {
  const { locale, slug } = await params;
  const post = await getPostBySlug(slug, locale);
  const hero = await getTranslations({ locale, namespace: "hero" });

  return new ImageResponse(
    (
      <div
        style={{
          width: "100%",
          height: "100%",
          display: "flex",
          flexDirection: "column",
          justifyContent: "space-between",
          backgroundColor: "#0c1222",
          color: "#e2e8f0",
          fontFamily: "sans-serif",
          padding: 80,
        }}
      >
        <div
          style={{
            display: "flex",
            flexDirection: "column",
          }}
        >
          <div
            style={{
              display: "flex",
              fontSize: 22,
              color: "#06b6d4",
              marginBottom: 24,
            }}
          >
            {hero("name")} — Blog
          </div>
          <div
            style={{
              display: "flex",
              fontSize: 52,
              fontWeight: 700,
              marginBottom: 20,
              lineHeight: 1.2,
            }}
          >
            {post.frontmatter.title}
          </div>
          <div
            style={{
              display: "flex",
              fontSize: 24,
              color: "#94a3b8",
              lineHeight: 1.4,
            }}
          >
            {post.frontmatter.description}
          </div>
        </div>
        <div
          style={{
            display: "flex",
            fontSize: 18,
            color: "#475569",
          }}
        >
          {post.frontmatter.date}
        </div>
      </div>
    ),
    { ...size },
  );
}
