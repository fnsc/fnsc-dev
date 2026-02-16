import type { Metadata } from "next";
import { setRequestLocale } from "next-intl/server";
import { getTranslations } from "next-intl/server";
import { routing } from "@/i18n/routing";
import { getAllPosts } from "@/lib/blog";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import AnimatedSection from "@/components/AnimatedSection";
import SectionHeading from "@/components/ui/SectionHeading";
import Card from "@/components/ui/Card";
import Link from "next/link";

const BASE_URL = "https://fnsc.dev";

export async function generateMetadata({
  params,
}: {
  params: Promise<{ locale: string }>;
}): Promise<Metadata> {
  const { locale } = await params;
  const t = await getTranslations({ locale, namespace: "blog" });
  const hero = await getTranslations({ locale, namespace: "hero" });

  const title = `${t("title")} – ${hero("name")}`;
  const description = t("description");
  const url = `${BASE_URL}/${locale}/blog`;

  return {
    title,
    description,
    alternates: {
      canonical: url,
      languages: Object.fromEntries(
        routing.locales.map((l) => [l, `${BASE_URL}/${l}/blog`]),
      ),
    },
    openGraph: {
      title,
      description,
      url,
      type: "website",
      locale,
      siteName: hero("name"),
    },
    twitter: {
      card: "summary_large_image",
      title,
      description,
    },
  };
}

export default async function BlogPage({
  params,
}: {
  params: Promise<{ locale: string }>;
}) {
  const { locale } = await params;
  setRequestLocale(locale);

  const t = await getTranslations({ locale, namespace: "blog" });
  const posts = await getAllPosts(locale);

  return (
    <>
      <Header />
      <main className="pt-20">
        <AnimatedSection className="px-4 py-20">
          <div className="mx-auto max-w-4xl">
            <SectionHeading>{t("title")}</SectionHeading>

            <div className="grid gap-6">
              {posts.map((post) => (
                <Link key={post.slug} href={`/${locale}/blog/${post.slug}`}>
                  <Card className="transition-colors hover:border-primary">
                    <time className="text-xs text-fg-secondary">
                      {post.frontmatter.date}
                    </time>
                    <h3 className="mt-1 text-xl font-semibold">
                      {post.frontmatter.title}
                    </h3>
                    <p className="mt-2 text-sm text-fg-secondary">
                      {post.frontmatter.description}
                    </p>
                    <span className="mt-3 inline-block text-sm font-medium text-primary">
                      {t("readMore")} &rarr;
                    </span>
                  </Card>
                </Link>
              ))}
            </div>
          </div>
        </AnimatedSection>
      </main>
      <Footer />
    </>
  );
}
