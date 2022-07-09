<?php

namespace Fnsc\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;

class ViewVarsTest extends TestCase
{
    public function testShouldGetViewVarsInstance(): void
    {
        // Actions
        $icons = ['heart' => ['path' => 'random/path']];

        $result = new ViewVars(
            location: 'Home',
            title: 'title',
            description: 'description',
            author: 'author',
            themeColor: 'themeColor',
            keywords: 'keywords',
            icons: $icons,
        );

        // Assertions
        $this->assertSame('Home', $result->getLocation());
        $this->assertSame('title', $result->getTitle());
        $this->assertSame('description', $result->getDescription());
        $this->assertSame('author', $result->getAuthor());
        $this->assertSame('themeColor', $result->getThemeColor());
        $this->assertSame('keywords', $result->getKeywords());
        $this->assertSame($icons, $result->getIcons());
    }
}
