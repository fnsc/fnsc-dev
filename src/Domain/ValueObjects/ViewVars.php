<?php

namespace Fnsc\Domain\ValueObjects;

class ViewVars
{
    /**
     * @param string                               $location
     * @param string                               $title
     * @param string                               $description
     * @param string                               $author
     * @param string                               $themeColor
     * @param string                               $keywords
     * @param array<string, array<string, string>> $icons
     */
    public function __construct(
        private readonly string $location,
        private readonly string $title,
        private readonly string $description,
        private readonly string $author,
        private readonly string $themeColor,
        private readonly string $keywords,
        private readonly array $icons,
    ) {
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getThemeColor(): string
    {
        return $this->themeColor;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getKeywords(): string
    {
        return $this->keywords;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function getIcons(): array
    {
        return $this->icons;
    }
}
