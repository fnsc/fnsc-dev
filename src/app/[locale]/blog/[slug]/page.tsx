import type { Metadata } from "next";
import { setRequestLocale } from "next-intl/server";
import { getTranslations } from "next-intl/server";
import { routing } from "@/i18n/routing";
import { getPostBySlug, getPostSlugs } from "@/lib/blog";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import Link from "next/link";
import AnimatedSection from "@/components/AnimatedSection";

const BASE_URL = "https://fnsc.dev";

export function generateStaticParams() {
  const params: { locale: string; slug: string }[] = [];
  for (const locale of routing.locales) {
    for (const slug of getPostSlugs(locale)) {
      params.push({ locale, slug });
    }
  }
  return params;
}

export async function generateMetadata({
  params,
}: {
  params: Promise<{ locale: string; slug: string }>;
}): Promise<Metadata> {
  const { locale, slug } = await params;
  const post = await getPostBySlug(slug, locale);
  const hero = await getTranslations({ locale, namespace: "hero" });

  const title = `${post.frontmatter.title} – ${hero("name")}`;
  const description = post.frontmatter.description;
  const url = `${BASE_URL}/${locale}/blog/${slug}`;

  return {
    title,
    description,
    alternates: {
      canonical: url,
      languages: Object.fromEntries(
        routing.locales.map((l) => [l, `${BASE_URL}/${l}/blog/${slug}`]),
      ),
    },
    openGraph: {
      title,
      description,
      url,
      type: "article",
      locale,
      siteName: hero("name"),
      publishedTime: post.frontmatter.date,
    },
    twitter: {
      card: "summary_large_image",
      title,
      description,
    },
  };
}

export default async function BlogPostPage({
  params,
}: {
  params: Promise<{ locale: string; slug: string }>;
}) {
  const { locale, slug } = await params;
  setRequestLocale(locale);

  const t = await getTranslations({ locale, namespace: "blog" });
  const post = await getPostBySlug(slug, locale);

  return (
    <>
      <Header />
      <main className="pt-20">
        <AnimatedSection className="px-4 py-20">
          <article className="mx-auto max-w-3xl">
            <Link
              href={`/${locale}/blog`}
              className="mb-8 inline-block text-sm font-medium text-primary hover:underline"
            >
              &larr; {t("backToBlog")}
            </Link>

            <header className="mb-10">
              <time className="text-sm text-fg-secondary">
                {post.frontmatter.date}
              </time>
              <h1 className="mt-2 text-4xl font-bold">
                {post.frontmatter.title}
              </h1>
              <p className="mt-3 text-lg text-fg-secondary">
                {post.frontmatter.description}
              </p>
            </header>

            <div
              className="blog-content"
              dangerouslySetInnerHTML={{ __html: post.content }}
            />
          </article>
        </AnimatedSection>
      </main>
      <Footer />
    </>
  );
}
