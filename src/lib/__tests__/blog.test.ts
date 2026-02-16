import { describe, it, expect } from "vitest";
import { getPostSlugs, getPostBySlug, getAllPosts } from "@/lib/blog";

describe("getPostSlugs", () => {
  it("returns slugs for an existing locale", () => {
    const slugs = getPostSlugs("en-CA");

    expect(slugs.length).toBeGreaterThan(0);
    expect(slugs).toContain("hello-world");
  });

  it("returns slugs for all supported locales", () => {
    for (const locale of ["en-CA", "fr-CA", "pt-BR"]) {
      const slugs = getPostSlugs(locale);
      expect(slugs.length).toBeGreaterThan(0);
    }
  });

  it("returns an empty array for a non-existent locale", () => {
    const slugs = getPostSlugs("xx-XX");

    expect(slugs).toEqual([]);
  });
});

describe("getPostBySlug", () => {
  it("returns parsed frontmatter and HTML content", async () => {
    const post = await getPostBySlug("hello-world", "en-CA");

    expect(post.slug).toBe("hello-world");
    expect(post.frontmatter.title).toBeTruthy();
    expect(post.frontmatter.date).toMatch(/^\d{4}-\d{2}-\d{2}$/);
    expect(post.frontmatter.description).toBeTruthy();
    expect(post.content).toContain("<");
  });

  it("returns localized content per locale", async () => {
    const enPost = await getPostBySlug("hello-world", "en-CA");
    const ptPost = await getPostBySlug("hello-world", "pt-BR");
    const frPost = await getPostBySlug("hello-world", "fr-CA");

    expect(enPost.frontmatter.description).not.toBe(
      ptPost.frontmatter.description,
    );
    expect(frPost.frontmatter.description).not.toBe(
      enPost.frontmatter.description,
    );
  });

  it("throws for a non-existent slug", async () => {
    await expect(getPostBySlug("does-not-exist", "en-CA")).rejects.toThrow();
  });
});

describe("getAllPosts", () => {
  it("returns all posts for a locale", async () => {
    const posts = await getAllPosts("en-CA");

    expect(posts.length).toBeGreaterThan(0);
    for (const post of posts) {
      expect(post.slug).toBeTruthy();
      expect(post.frontmatter.title).toBeTruthy();
      expect(post.frontmatter.date).toBeTruthy();
      expect(post.frontmatter.description).toBeTruthy();
      expect(post.content).toBeTruthy();
    }
  });

  it("returns posts sorted by date descending", async () => {
    const posts = await getAllPosts("en-CA");

    for (let i = 1; i < posts.length; i++) {
      const prev = new Date(posts[i - 1].frontmatter.date).getTime();
      const curr = new Date(posts[i].frontmatter.date).getTime();
      expect(prev).toBeGreaterThanOrEqual(curr);
    }
  });

  it("returns an empty array for a non-existent locale", async () => {
    const posts = await getAllPosts("xx-XX");

    expect(posts).toEqual([]);
  });
});
