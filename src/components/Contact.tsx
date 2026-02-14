"use client";

import { useTranslations } from "next-intl";
import AnimatedSection from "./AnimatedSection";
import { contactInfo } from "@/data/resume";

export default function Contact() {
  const t = useTranslations("contact");

  return (
    <AnimatedSection id="contact" className="bg-[var(--bg-secondary)] px-4 py-20">
      <div className="mx-auto max-w-4xl text-center">
        <h2 className="mb-4 text-3xl font-bold">
          <span className="text-primary">#</span> {t("title")}
        </h2>
        <p className="mx-auto mb-12 max-w-xl text-[var(--fg-secondary)]">
          {t("subtitle")}
        </p>

        <div className="mx-auto mb-10 grid max-w-2xl gap-6 sm:grid-cols-3">
          <div className="rounded-xl border border-[var(--card-border)] bg-[var(--card-bg)] p-6">
            <svg className="mx-auto mb-3 h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
              <path strokeLinecap="round" strokeLinejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <p className="mb-1 text-xs font-medium uppercase tracking-wider text-[var(--fg-secondary)]">
              {t("email")}
            </p>
            <a href={`mailto:${contactInfo.email}`} className="text-sm font-medium hover:text-primary">
              {contactInfo.email}
            </a>
          </div>

          <div className="rounded-xl border border-[var(--card-border)] bg-[var(--card-bg)] p-6">
            <svg className="mx-auto mb-3 h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
              <path strokeLinecap="round" strokeLinejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <p className="mb-1 text-xs font-medium uppercase tracking-wider text-[var(--fg-secondary)]">
              {t("phone")}
            </p>
            <a href={`tel:${contactInfo.phone}`} className="text-sm font-medium hover:text-primary">
              {contactInfo.phone}
            </a>
          </div>

          <div className="rounded-xl border border-[var(--card-border)] bg-[var(--card-bg)] p-6">
            <svg className="mx-auto mb-3 h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
              <path strokeLinecap="round" strokeLinejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path strokeLinecap="round" strokeLinejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <p className="mb-1 text-xs font-medium uppercase tracking-wider text-[var(--fg-secondary)]">
              {t("address")}
            </p>
            <p className="text-sm font-medium">{contactInfo.address}</p>
          </div>
        </div>

        <a
          href={`mailto:${contactInfo.email}`}
          className="inline-flex items-center gap-2 rounded-full bg-primary px-8 py-3 text-lg font-semibold text-white transition-opacity hover:opacity-90"
        >
          {t("sendEmail")}
        </a>
      </div>
    </AnimatedSection>
  );
}
