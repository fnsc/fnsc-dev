<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Infra\Repositories\User;
use Illuminate\Foundation\Application;
use PHPUnit\Framework\TestCase;

class UserRepositoryServiceProviderTest extends TestCase
{
    public function testShouldReturnAnArrayWithTheProvidedResources(): void
    {
        // Set
        $app = new Application();
        $serviceProvider = new UserRepositoryServiceProvider($app);

        // Actions
        $result = $serviceProvider->provides();

        // Assertions
        $this->assertSame([User::class], $result);
    }
}
