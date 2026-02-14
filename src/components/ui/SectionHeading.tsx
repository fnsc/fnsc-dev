export default function SectionHeading({
  children,
  className = "mb-12",
}: {
  children: string;
  className?: string;
}) {
  return (
    <h2 className={`text-3xl font-bold ${className}`}>
      <span className="text-primary">#</span> {children}
    </h2>
  );
}
