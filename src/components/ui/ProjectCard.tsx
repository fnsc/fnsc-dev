import { ReactNode } from "react";
import Badge from "./Badge";

interface ProjectCardProps {
  href: string;
  name: string;
  roleLabel: string;
  badgeVariant: "primary" | "subtle";
  icon: ReactNode;
}

export function badgeVariantForRole(role: string): "primary" | "subtle" {
  if (role === "owner") return "primary";
  return "subtle";
}

export default function ProjectCard({
  href,
  name,
  roleLabel,
  badgeVariant,
  icon,
}: ProjectCardProps) {
  return (
    <a
      href={href}
      target="_blank"
      rel="noopener noreferrer"
      className="group flex items-start gap-4 rounded-xl border border-card-border bg-card-bg p-6 transition-colors hover:border-primary"
    >
      <div className="flex-1">
        <h3 className="mb-2 text-lg font-semibold group-hover:text-primary">
          {name}
        </h3>
        <Badge variant={badgeVariant}>{roleLabel}</Badge>
      </div>
      {icon}
    </a>
  );
}
