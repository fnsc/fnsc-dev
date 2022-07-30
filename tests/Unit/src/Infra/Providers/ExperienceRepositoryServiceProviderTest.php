<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Domain\Contracts\ExperienceRepository;
use Illuminate\Foundation\Application;
use PHPUnit\Framework\TestCase;

class ExperienceRepositoryServiceProviderTest extends TestCase
{
    public function testShouldReturnAnArrayWithTheProvidedResources(): void
    {
        // Set
        $app = new Application();
        $serviceProvider = new ExperienceRepositoryServiceProvider($app);

        // Actions
        $result = $serviceProvider->provides();

        // Assertions
        $this->assertSame([ExperienceRepository::class], $result);
    }
}
