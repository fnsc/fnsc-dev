<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Infra\Adapters\Config;
use Illuminate\Foundation\Application;
use PHPUnit\Framework\TestCase;

class ConfigAdapterServiceProviderTest extends TestCase
{
    public function testShouldReturnAnArrayWithTheProvidedResources(): void
    {
        // Set
        $app = new Application();
        $serviceProvider = new ConfigAdapterServiceProvider($app);

        // Actions
        $result = $serviceProvider->provides();

        // Assertions
        $this->assertSame([Config::class], $result);
    }
}
