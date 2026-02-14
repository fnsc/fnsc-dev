# fnsc-dev

Site pessoal / portfólio construído com Next.js, Tailwind CSS e Framer Motion, com suporte a três idiomas (EN, FR, PT).

## Requisitos

- [Docker](https://docs.docker.com/get-docker/) e [Docker Compose](https://docs.docker.com/compose/)

## Rodando localmente

```bash
docker compose up --build
```

O site estará disponível em `https://fnsc.test` (certificado auto-assinado via Caddy).

Para aceitar o certificado local, adicione `fnsc.test` ao seu `/etc/hosts` apontando para `127.0.0.1`:

```
127.0.0.1 fnsc.test
```

### Comandos úteis

```bash
# Lint
docker compose exec app npm run lint

# Build de produção
docker compose exec app npm run build
```

## Stack

- **Next.js 16** — App Router com geração estática (SSG)
- **React 19** — Server e Client Components
- **Tailwind CSS 4** — Estilização utility-first com tema inline
- **Framer Motion** — Animações de entrada por scroll
- **next-intl** — Internacionalização (en-CA, fr-CA, pt-BR)
- **Caddy** — Reverse proxy com TLS automático

## Decisões de arquitetura

### Server vs Client Components

Componentes sem interatividade (`Footer`, `About`, `Education`, `Contact`) são **Server Components** — renderizam no servidor e não enviam JavaScript para o client. Componentes que usam hooks, state ou Framer Motion (`Header`, `Hero`, `Experience`, `TechStack`, `OpenSource`) permanecem como **Client Components**.

Componentes como `About` e `Education` usam o `AnimatedSection` (client) como wrapper, mas seu conteúdo é renderizado no servidor e passado como `children` — o React permite essa composição entre server e client.

### Design Tokens no Tailwind

As cores do tema (light/dark) são definidas como CSS custom properties (`:root` / `.dark`) e registradas no `@theme inline` do Tailwind. Isso permite usar classes semânticas como `text-fg-secondary` e `bg-card-bg` em vez de `text-[var(--fg-secondary)]`, mantendo o código mais limpo e com autocomplete no editor.

### Componentes UI reutilizáveis

Padrões visuais repetidos foram extraídos para `src/components/ui/`:

- **`Card`** — wrapper de card com borda e fundo do tema
- **`Badge`** — badge com variantes `primary` e `subtle`
- **`SectionHeading`** — título de seção com o padrão `# Título`

Isso reduz duplicação sem criar abstrações desnecessárias.

### Tipagem explícita do data layer

Interfaces em `src/types/resume.ts` tipam todas as estruturas de dados exportadas por `src/data/resume.ts`. Isso dá segurança de tipo e autocomplete sem adicionar validação runtime (desnecessária para dados estáticos).

### Separação de lógica de formatação

O parsing de strings de tecnologia (`.split(", ")`) foi movido para `src/lib/format.ts` em vez de ficar inline no JSX dos componentes. As strings permanecem no JSON de tradução (mais simples de manter para 3 idiomas).

## Estrutura do projeto

```
src/
├── app/[locale]/        # Layout e página principal (SSG por locale)
├── components/
│   ├── ui/              # Card, Badge, SectionHeading
│   ├── AnimatedSection  # Wrapper de animação (client)
│   └── ...              # Seções do site
├── data/
│   └── resume.ts        # Dados estáticos tipados
├── i18n/                # Configuração do next-intl
├── lib/
│   └── format.ts        # Helpers de formatação
└── types/
    └── resume.ts        # Interfaces TypeScript
```
