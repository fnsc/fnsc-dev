"use client";

import { useTranslations } from "next-intl";
import LanguageSwitcher from "./LanguageSwitcher";
import ThemeToggle from "./ThemeToggle";
import { useState } from "react";

const navItems = [
  { key: "about", href: "#about" },
  { key: "experience", href: "#experience" },
  { key: "techStack", href: "#tech-stack" },
  { key: "openSource", href: "#open-source" },
  { key: "education", href: "#education" },
  { key: "contact", href: "#contact" },
] as const;

export default function Header() {
  const t = useTranslations("nav");
  const [mobileOpen, setMobileOpen] = useState(false);

  return (
    <header className="fixed top-0 z-50 w-full border-b border-card-border bg-nav-bg backdrop-blur-md">
      <div className="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
        <a href="#" className="text-lg font-bold text-primary">
          GF
        </a>

        <nav className="hidden items-center gap-6 md:flex">
          {navItems.map(({ key, href }) => (
            <a
              key={key}
              href={href}
              className="text-sm font-medium text-fg-secondary transition-colors hover:text-primary"
            >
              {t(key)}
            </a>
          ))}
        </nav>

        <div className="flex items-center gap-2">
          <LanguageSwitcher />
          <ThemeToggle />
          <button
            onClick={() => setMobileOpen(!mobileOpen)}
            className="rounded-lg p-2 transition-colors hover:bg-card-bg md:hidden"
            aria-label="Menu"
          >
            <svg className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
              {mobileOpen ? (
                <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
              ) : (
                <path strokeLinecap="round" strokeLinejoin="round" d="M4 6h16M4 12h16M4 18h16" />
              )}
            </svg>
          </button>
        </div>
      </div>

      {mobileOpen && (
        <nav className="border-t border-card-border bg-bg px-4 py-4 md:hidden">
          {navItems.map(({ key, href }) => (
            <a
              key={key}
              href={href}
              onClick={() => setMobileOpen(false)}
              className="block py-2 text-sm font-medium text-fg-secondary transition-colors hover:text-primary"
            >
              {t(key)}
            </a>
          ))}
        </nav>
      )}
    </header>
  );
}
