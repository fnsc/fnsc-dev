<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Infra\Repositories\SocialMedia;
use Illuminate\Foundation\Application;
use PHPUnit\Framework\TestCase;

class SocialMediaRepositoryServiceProviderTest extends TestCase
{
    public function testShouldReturnAnArrayWithTheProvidedResources(): void
    {
        // Set
        $app = new Application();
        $serviceProvider = new SocialMediaRepositoryServiceProvider($app);

        // Actions
        $result = $serviceProvider->provides();

        // Assertions
        $this->assertSame([SocialMedia::class], $result);
    }
}
