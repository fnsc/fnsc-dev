import { renderToBuffer } from "@react-pdf/renderer";
import React from "react";
import { buildPdfResumeData } from "@/data/pdf-data";
import ResumeDocument from "@/components/pdf/ResumeDocument";

export async function GET(
  _request: Request,
  { params }: { params: Promise<{ locale: string }> },
) {
  const { locale } = await params;

  let data;
  try {
    data = await buildPdfResumeData(locale);
  } catch {
    return new Response(JSON.stringify({ error: "Invalid locale" }), {
      status: 400,
      headers: { "Content-Type": "application/json" },
    });
  }

  // @ts-expect-error -- @react-pdf/renderer types expect DocumentProps but the wrapper component is valid
  const buffer = await renderToBuffer(React.createElement(ResumeDocument, { data }));

  return new Response(new Uint8Array(buffer), {
    headers: {
      "Content-Type": "application/pdf",
      "Content-Disposition": `attachment; filename="gabriel-fonseca-resume-${locale}.pdf"`,
      "Cache-Control": "public, s-maxage=86400, stale-while-revalidate=3600",
    },
  });
}
