# fnsc-dev

Personal website / portfolio built with Next.js, Tailwind CSS and Framer Motion, with support for three languages (EN, FR, PT).

## Requirements

- [Docker](https://docs.docker.com/get-docker/) and [Docker Compose](https://docs.docker.com/compose/)

## Running locally

```bash
docker compose up --build
```

The site will be available at `https://fnsc.test` (self-signed certificate via Caddy).

To accept the local certificate, add `fnsc.test` to your `/etc/hosts` pointing to `127.0.0.1`:

```
127.0.0.1 fnsc.test
```

### Useful commands

```bash
# Lint
docker compose exec app npm run lint

# Production build
docker compose exec app npm run build
```

## Stack

- **Next.js 16** — App Router with static site generation (SSG)
- **React 19** — Server and Client Components
- **Tailwind CSS 4** — Utility-first styling with inline theme
- **Framer Motion** — Scroll-triggered entry animations
- **next-intl** — Internationalization (en-CA, fr-CA, pt-BR)
- **Caddy** — Reverse proxy with automatic TLS

## Architecture decisions

### Server vs Client Components

Components without interactivity (`Footer`, `About`, `Education`, `Contact`) are **Server Components** — they render on the server and ship no JavaScript to the client. Components that use hooks, state or Framer Motion (`Header`, `Hero`, `Experience`, `TechStack`, `OpenSource`) remain as **Client Components**.

Components like `About` and `Education` use `AnimatedSection` (client) as a wrapper, but their content is rendered on the server and passed as `children` — React allows this composition between server and client.

### Design Tokens in Tailwind

Theme colors (light/dark) are defined as CSS custom properties (`:root` / `.dark`) and registered in Tailwind's `@theme inline`. This allows using semantic classes like `text-fg-secondary` and `bg-card-bg` instead of `text-[var(--fg-secondary)]`, keeping the code cleaner and enabling editor autocomplete.

### Reusable UI components

Repeated visual patterns were extracted into `src/components/ui/`:

- **`Card`** — card wrapper with themed border and background
- **`Badge`** — badge with `primary` and `subtle` variants
- **`SectionHeading`** — section title with the `# Title` pattern

This reduces duplication without creating unnecessary abstractions.

### Explicit data layer typing

Interfaces in `src/types/resume.ts` type all data structures exported by `src/data/resume.ts`. This provides type safety and autocomplete without adding runtime validation (unnecessary for static data).

### Formatting logic separation

Tech string parsing (`.split(", ")`) was moved to `src/lib/format.ts` instead of being inline in component JSX. The strings remain in the translation JSON files (simpler to maintain across 3 languages).

## Project structure

```
src/
├── app/[locale]/        # Layout and main page (SSG per locale)
├── components/
│   ├── ui/              # Card, Badge, SectionHeading
│   ├── AnimatedSection  # Animation wrapper (client)
│   └── ...              # Site sections
├── data/
│   └── resume.ts        # Typed static data
├── i18n/                # next-intl configuration
├── lib/
│   └── format.ts        # Formatting helpers
└── types/
    └── resume.ts        # TypeScript interfaces
```
