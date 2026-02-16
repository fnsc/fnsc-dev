import fs from "fs";
import path from "path";
import matter from "gray-matter";
import { unified } from "unified";
import remarkParse from "remark-parse";
import remarkRehype from "remark-rehype";
import rehypeStringify from "rehype-stringify";
import rehypeHighlight from "rehype-highlight";

const contentDir = path.join(process.cwd(), "content", "blog");

export interface PostFrontmatter {
  title: string;
  date: string;
  description: string;
}

export interface Post {
  slug: string;
  frontmatter: PostFrontmatter;
  content: string;
}

export function getPostSlugs(locale: string): string[] {
  const localeDir = path.join(contentDir, locale);
  if (!fs.existsSync(localeDir)) return [];
  return fs
    .readdirSync(localeDir)
    .filter((file) => file.endsWith(".md"))
    .map((file) => file.replace(/\.md$/, ""));
}

export async function getPostBySlug(
  slug: string,
  locale: string,
): Promise<Post> {
  const filePath = path.join(contentDir, locale, `${slug}.md`);
  const fileContents = fs.readFileSync(filePath, "utf-8");
  const { data, content: rawContent } = matter(fileContents);

  const result = await unified()
    .use(remarkParse)
    .use(remarkRehype)
    .use(rehypeHighlight)
    .use(rehypeStringify)
    .process(rawContent);

  return {
    slug,
    frontmatter: data as PostFrontmatter,
    content: result.toString(),
  };
}

export async function getAllPosts(locale: string): Promise<Post[]> {
  const slugs = getPostSlugs(locale);
  const posts = await Promise.all(
    slugs.map((slug) => getPostBySlug(slug, locale)),
  );
  return posts.sort(
    (a, b) =>
      new Date(b.frontmatter.date).getTime() -
      new Date(a.frontmatter.date).getTime(),
  );
}
