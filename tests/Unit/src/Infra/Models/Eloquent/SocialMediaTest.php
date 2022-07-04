<?php

namespace Fnsc\Infra\Models\Eloquent;

use Database\Factories\SocialMediaFactory;
use PHPUnit\Framework\TestCase;

class SocialMediaTest extends TestCase
{
    public function testShouldGetSocialMediaFactory(): void
    {
        // Set
        $socialMedia = new SocialMedia();

        // Actions
        $result = $socialMedia::factory();

        // Assertions
        $this->assertInstanceOf(SocialMediaFactory::class, $result);
    }
}
