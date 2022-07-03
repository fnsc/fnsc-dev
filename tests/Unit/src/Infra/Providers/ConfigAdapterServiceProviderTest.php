<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Application\Contracts\Config as ConfigContract;
use Fnsc\Infra\Adapters\Config;
use Illuminate\Foundation\Application;
use Tests\TestCase;

class ConfigAdapterServiceProviderTest extends TestCase
{
    public function testShouldRegisterTheContractIntoTheFrameworkContainer(): void
    {
        // Set
        $app = new Application();
        $serviceProvider = new ConfigAdapterServiceProvider($app);

        // Actions
        $serviceProvider->register();
        $config = $this->app->make(ConfigContract::class);

        // Assertions
        $this->assertInstanceOf(Config::class, $config);
    }

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
