<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Domain\Contracts\SocialMediaRepository;
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
        $this->assertSame([SocialMediaRepository::class], $result);
    }
}
