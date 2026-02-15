import React from "react";
import { Document, Page, Text, View, Link, StyleSheet } from "@react-pdf/renderer";
import type { PdfResumeData } from "@/types/pdf";

const styles = StyleSheet.create({
  page: {
    fontFamily: "Helvetica",
    fontSize: 10,
    padding: "40 50",
    lineHeight: 1.4,
    color: "#1a1a1a",
  },
  header: {
    marginBottom: 16,
    borderBottom: "1.5pt solid #333",
    paddingBottom: 10,
  },
  name: {
    fontSize: 18,
    fontFamily: "Helvetica-Bold",
    marginBottom: 2,
  },
  title: {
    fontSize: 12,
    color: "#444",
    marginBottom: 6,
  },
  contactRow: {
    flexDirection: "row",
    flexWrap: "wrap",
    gap: 4,
    fontSize: 9,
    color: "#555",
  },
  contactItem: {
    marginRight: 8,
  },
  link: {
    color: "#555",
    textDecoration: "none",
  },
  sectionTitle: {
    fontSize: 12,
    fontFamily: "Helvetica-Bold",
    textTransform: "uppercase",
    marginTop: 14,
    marginBottom: 6,
    borderBottom: "0.75pt solid #999",
    paddingBottom: 3,
  },
  jobHeader: {
    flexDirection: "row",
    justifyContent: "space-between",
    marginBottom: 2,
  },
  jobRole: {
    fontFamily: "Helvetica-Bold",
    fontSize: 10,
  },
  jobPeriod: {
    fontSize: 9,
    color: "#555",
  },
  jobCompany: {
    fontSize: 9,
    color: "#555",
    marginBottom: 3,
  },
  jobDescription: {
    marginBottom: 3,
  },
  jobTech: {
    fontSize: 9,
    color: "#444",
    fontFamily: "Helvetica-Oblique",
  },
  jobBlock: {
    marginBottom: 10,
  },
  skillRow: {
    flexDirection: "row",
    marginBottom: 2,
  },
  skillCategory: {
    fontFamily: "Helvetica-Bold",
    width: 80,
  },
  skillItems: {
    flex: 1,
  },
  eduBlock: {
    marginBottom: 4,
  },
  eduTitle: {
    fontFamily: "Helvetica-Bold",
  },
  certItem: {
    marginBottom: 1,
  },
  osBlock: {
    flexDirection: "row",
    marginBottom: 2,
  },
  osName: {
    fontFamily: "Helvetica-Bold",
  },
  osRole: {
    color: "#555",
    fontSize: 9,
  },
});

export default function ResumeDocument({ data }: { data: PdfResumeData }) {
  return (
    <Document
      title={`${data.name} — ${data.title}`}
      author={data.name}
      subject={`Resume / CV — ${data.title}`}
      keywords="Software Engineer, PHP, Laravel, Symfony, Node.js, Go, TypeScript, React, Vue, AWS, Docker, PostgreSQL, MySQL, MongoDB, REST API, TDD, Agile"
    >
      <Page size="A4" style={styles.page}>
        {/* Header */}
        <View style={styles.header}>
          <Text style={styles.name}>{data.name}</Text>
          <Text style={styles.title}>{data.title}</Text>
          <View style={styles.contactRow}>
            <Text style={styles.contactItem}>{data.contact.email}</Text>
            <Text style={styles.contactItem}>|</Text>
            <Text style={styles.contactItem}>{data.contact.phone}</Text>
            <Text style={styles.contactItem}>|</Text>
            <Text style={styles.contactItem}>{data.contact.address}</Text>
            <Text style={styles.contactItem}>|</Text>
            <Link src={data.contact.github} style={styles.link}>
              <Text style={styles.contactItem}>github.com/fnsc</Text>
            </Link>
            <Text style={styles.contactItem}>|</Text>
            <Link src={data.contact.linkedin} style={styles.link}>
              <Text style={styles.contactItem}>linkedin.com/in/fnsc</Text>
            </Link>
            <Text style={styles.contactItem}>|</Text>
            <Link src={data.contact.website} style={styles.link}>
              <Text style={styles.contactItem}>fnsc.dev</Text>
            </Link>
          </View>
        </View>

        {/* Summary */}
        <View>
          <Text style={styles.sectionTitle}>{data.labels.summary}</Text>
          <Text>{data.summary}</Text>
        </View>

        {/* Experience */}
        <View>
          <Text style={styles.sectionTitle}>{data.labels.experience}</Text>
          {data.jobs.map((job, i) => (
            <View key={i} style={styles.jobBlock}>
              <View style={styles.jobHeader}>
                <Text style={styles.jobRole}>{job.role}</Text>
                <Text style={styles.jobPeriod}>{job.period}</Text>
              </View>
              <Text style={styles.jobCompany}>{job.company}</Text>
              {job.description.split("\n").map((line, j) => (
                <Text key={j} style={styles.jobDescription}>
                  • {line}
                </Text>
              ))}
              <Text style={styles.jobTech}>
                {data.labels.technologies}: {job.tech}
              </Text>
            </View>
          ))}
        </View>

        {/* Skills */}
        <View>
          <Text style={styles.sectionTitle}>{data.labels.skills}</Text>
          {Object.entries(data.techStack).map(([category, items]) => (
            <View key={category} style={styles.skillRow}>
              <Text style={styles.skillCategory}>
                {data.categoryLabels[category]}
              </Text>
              <Text style={styles.skillItems}>{items.join(", ")}</Text>
            </View>
          ))}
        </View>

        {/* Education & Certifications */}
        <View>
          <Text style={styles.sectionTitle}>
            {data.labels.education} &amp; {data.labels.certificates}
          </Text>
          <View style={styles.eduBlock}>
            <Text style={styles.eduTitle}>
              {data.education.program} — {data.education.field}
            </Text>
            <Text>
              {data.education.institution} | {data.education.period}
            </Text>
          </View>
          {data.certifications.map((cert, i) => (
            <Text key={i} style={styles.certItem}>
              • {cert}
            </Text>
          ))}
        </View>

        {/* Open Source */}
        <View>
          <Text style={styles.sectionTitle}>{data.labels.openSource}</Text>
          {data.openSource.map((project, i) => (
            <View key={i} style={styles.osBlock}>
              <Text>
                <Text style={styles.osName}>{project.name}</Text>
                <Text style={styles.osRole}> ({project.role})</Text>
                <Text> — {project.description} — </Text>
                <Link src={project.url} style={styles.link}>
                  <Text>{project.url}</Text>
                </Link>
              </Text>
            </View>
          ))}
        </View>
      </Page>
    </Document>
  );
}
