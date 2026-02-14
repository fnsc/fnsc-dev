import type { Metadata } from "next";
import { Inter } from "next/font/google";
import { NextIntlClientProvider, hasLocale } from "next-intl";
import { getTranslations, setRequestLocale } from "next-intl/server";
import { notFound } from "next/navigation";
import { routing } from "@/i18n/routing";
import "../globals.css";

const inter = Inter({
  subsets: ["latin"],
  weight: ["300", "400", "500", "600", "700", "800"],
  display: "swap",
});

const BASE_URL = "https://fnsc.dev";

export async function generateStaticParams() {
  return routing.locales.map((locale) => ({ locale }));
}

export async function generateMetadata({
  params,
}: {
  params: Promise<{ locale: string }>;
}): Promise<Metadata> {
  const { locale } = await params;
  const hero = await getTranslations({ locale, namespace: "hero" });
  const meta = await getTranslations({ locale, namespace: "meta" });

  const title = `${hero("name")} – ${hero("title")}`;
  const description = meta("description");
  const url = `${BASE_URL}/${locale}`;

  return {
    metadataBase: new URL(BASE_URL),
    title,
    description,
    alternates: {
      canonical: url,
      languages: {
        "en-CA": `${BASE_URL}/en-CA`,
        "fr-CA": `${BASE_URL}/fr-CA`,
        "pt-BR": `${BASE_URL}/pt-BR`,
      },
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

export default async function LocaleLayout({
  children,
  params,
}: {
  children: React.ReactNode;
  params: Promise<{ locale: string }>;
}) {
  const { locale } = await params;

  if (!hasLocale(routing.locales, locale)) {
    notFound();
  }

  setRequestLocale(locale);

  const hero = await getTranslations({ locale, namespace: "hero" });

  const jsonLd = {
    "@context": "https://schema.org",
    "@type": "Person",
    name: hero("name"),
    jobTitle: hero("title"),
    url: `${BASE_URL}/${locale}`,
    sameAs: [
      "https://github.com/fnsc",
      "https://linkedin.com/in/fnsc",
    ],
    email: "mailto:hi@fnsc.dev",
  };

  return (
    <html lang={locale} className={`dark ${inter.className}`} suppressHydrationWarning>
      <head>
        <script
          type="application/ld+json"
          dangerouslySetInnerHTML={{ __html: JSON.stringify(jsonLd) }}
        />
      </head>
      <body className="antialiased">
        <NextIntlClientProvider>
          <ThemeInitScript />
          {children}
        </NextIntlClientProvider>
      </body>
    </html>
  );
}

function ThemeInitScript() {
  const script = `
    (function() {
      const theme = localStorage.getItem('theme');
      if (theme === 'light') {
        document.documentElement.classList.remove('dark');
      } else {
        document.documentElement.classList.add('dark');
      }
    })();
  `;
  return <script dangerouslySetInnerHTML={{ __html: script }} />;
}
