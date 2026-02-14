import { ImageResponse } from "next/og";
import { getTranslations } from "next-intl/server";
import { routing } from "@/i18n/routing";

export const alt = "Gabriel Fonseca – Software Engineer";
export const size = { width: 1200, height: 630 };
export const contentType = "image/png";

export function generateStaticParams() {
  return routing.locales.map((locale) => ({ locale }));
}

export default async function OGImage({
  params,
}: {
  params: Promise<{ locale: string }>;
}) {
  const { locale } = await params;
  const t = await getTranslations({ locale, namespace: "hero" });

  return new ImageResponse(
    (
      <div
        style={{
          width: "100%",
          height: "100%",
          display: "flex",
          flexDirection: "column",
          alignItems: "center",
          justifyContent: "center",
          backgroundColor: "#0c1222",
          color: "#e2e8f0",
          fontFamily: "sans-serif",
        }}
      >
        <div
          style={{
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
            width: 100,
            height: 100,
            backgroundColor: "#2563eb",
            borderRadius: 20,
            fontSize: 56,
            fontWeight: 700,
            color: "#ffffff",
            marginBottom: 32,
          }}
        >
          GF
        </div>
        <div
          style={{
            fontSize: 56,
            fontWeight: 700,
            marginBottom: 12,
          }}
        >
          {t("name")}
        </div>
        <div
          style={{
            fontSize: 28,
            color: "#06b6d4",
            marginBottom: 16,
          }}
        >
          {t("title")}
        </div>
        <div
          style={{
            fontSize: 22,
            color: "#94a3b8",
          }}
        >
          {t("subtitle")}
        </div>
      </div>
    ),
    { ...size },
  );
}
