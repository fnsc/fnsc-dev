<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Domain\Contracts\SocialMediaRepository;
use Fnsc\Infra\Repositories\SocialMedia;
use Illuminate\Foundation\Application;
use Tests\TestCase;

class SocialMediaRepositoryServiceProviderTest extends TestCase
{
    public function testShouldRegisterTheContractIntoTheFrameworkContainer(): void
    {
        // Set
        $app = new Application();
        $serviceProvider = new SocialMediaRepositoryServiceProvider($app);

        // Actions
        $serviceProvider->register();
        $repository = $this->app->make(SocialMediaRepository::class);

        // Assertions
        $this->assertInstanceOf(SocialMedia::class, $repository);
    }

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
