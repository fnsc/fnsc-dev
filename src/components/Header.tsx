"use client";

import { useLocale, useTranslations } from "next-intl";
import { usePathname } from "next/navigation";
import LanguageSwitcher from "./LanguageSwitcher";
import ThemeToggle from "./ThemeToggle";
import { useState } from "react";
import { AnimatePresence, motion } from "framer-motion";

const navItems = [
  { key: "about", href: "#about" },
  { key: "experience", href: "#experience" },
  { key: "techStack", href: "#tech-stack" },
  { key: "openSource", href: "#open-source" },
  { key: "education", href: "#education" },
  { key: "contact", href: "#contact" },
] as const;

const blogNavItem = { key: "blog" } as const;

export default function Header() {
  const t = useTranslations("nav");
  const locale = useLocale();
  const pathname = usePathname();
  const isHome = pathname === `/${locale}` || pathname === `/${locale}/`;
  const [mobileOpen, setMobileOpen] = useState(false);

  return (
    <header className="fixed top-0 z-50 w-full border-b border-card-border bg-nav-bg backdrop-blur-md">
      <div className="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
        <a href={`/${locale}`} className="text-lg font-bold text-primary">
          GF
        </a>

        <nav className="hidden items-center gap-6 md:flex">
          {navItems.map(({ key, href }) => (
            <a
              key={key}
              href={isHome ? href : `/${locale}/${href}`}
              className="text-sm font-medium text-fg-secondary transition-colors hover:text-primary"
            >
              {t(key)}
            </a>
          ))}
          <a
            href={`/${locale}/blog`}
            className="text-sm font-medium text-fg-secondary transition-colors hover:text-primary"
          >
            {t(blogNavItem.key)}
          </a>
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

      <AnimatePresence>
        {mobileOpen && (
          <motion.nav
            initial={{ height: 0, opacity: 0 }}
            animate={{ height: "auto", opacity: 1 }}
            exit={{ height: 0, opacity: 0 }}
            transition={{ duration: 0.2, ease: "easeInOut" }}
            className="overflow-hidden border-t border-card-border bg-bg md:hidden"
          >
            <div className="px-4 py-4">
              {navItems.map(({ key, href }, i) => (
                <motion.a
                  key={key}
                  href={isHome ? href : `/${locale}/${href}`}
                  onClick={() => setMobileOpen(false)}
                  initial={{ x: -20, opacity: 0 }}
                  animate={{ x: 0, opacity: 1 }}
                  transition={{ delay: i * 0.03 }}
                  className="block py-2 text-sm font-medium text-fg-secondary transition-colors hover:text-primary"
                >
                  {t(key)}
                </motion.a>
              ))}
              <motion.a
                href={`/${locale}/blog`}
                onClick={() => setMobileOpen(false)}
                initial={{ x: -20, opacity: 0 }}
                animate={{ x: 0, opacity: 1 }}
                transition={{ delay: navItems.length * 0.03 }}
                className="block py-2 text-sm font-medium text-fg-secondary transition-colors hover:text-primary"
              >
                {t(blogNavItem.key)}
              </motion.a>
            </div>
          </motion.nav>
        )}
      </AnimatePresence>
    </header>
  );
}
