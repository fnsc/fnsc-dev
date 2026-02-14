import { ReactNode } from "react";

export default function Badge({
  children,
  variant = "primary",
}: {
  children: ReactNode;
  variant?: "primary" | "subtle";
}) {
  const styles = {
    primary: "bg-primary/10 text-primary",
    subtle: "bg-card-border text-fg-secondary",
  };

  return (
    <span
      className={`inline-block rounded-full px-3 py-1 text-xs font-medium ${styles[variant]}`}
    >
      {children}
    </span>
  );
}
