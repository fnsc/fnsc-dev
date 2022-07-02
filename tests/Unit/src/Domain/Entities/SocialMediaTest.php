<?php

namespace Fnsc\Domain\Entities;

use Fnsc\Domain\ValueObjects\Url;
use MongoDB\BSON\ObjectId;
use PHPUnit\Framework\TestCase;

class SocialMediaTest extends TestCase
{
    public function testShouldGetSocialMediaEntityInstance(): void
    {
        // Actions
        $result = SocialMedia::getNewSocialMedia(
            'GitHub',
            'johnDoe',
            'https://github.com/johnDoe',
            'img/social/github.svg',
            '62c0976174676bafdb060ae0'
        );

        // Assertions
        $this->assertInstanceOf(SocialMedia::class, $result);
        $this->assertInstanceOf(ObjectId::class, $result->getId());
        $this->assertInstanceOf(Url::class, $result->getProfileUrl());
        $this->assertSame(
            '62c0976174676bafdb060ae0',
            (string) $result->getId()
        );
        $this->assertSame(
            'https://github.com/johnDoe',
            (string) $result->getProfileUrl()
        );
        $this->assertSame('GitHub', $result->getName());
        $this->assertSame('johnDoe', $result->getUsername());
        $this->assertSame('img/social/github.svg', $result->getIconPath());
    }
}
