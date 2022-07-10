<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Application\Contracts\UrlGenerator;
use Illuminate\Foundation\Application;
use PHPUnit\Framework\TestCase;

class UrlGeneratorServiceProviderTest extends TestCase
{
    public function testShouldReturnAnArrayWithTheProvidedResources(): void
    {
        // Set
        $app = new Application();
        $serviceProvider = new UrlGeneratorServiceProvider($app);

        // Actions
        $result = $serviceProvider->provides();

        // Assertions
        $this->assertSame([UrlGenerator::class], $result);
    }
}
