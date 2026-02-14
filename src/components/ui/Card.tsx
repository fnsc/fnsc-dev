import { ReactNode } from "react";

export default function Card({
  children,
  className = "",
}: {
  children: ReactNode;
  className?: string;
}) {
  return (
    <div
      className={`rounded-xl border border-card-border bg-card-bg p-6 ${className}`}
    >
      {children}
    </div>
  );
}
