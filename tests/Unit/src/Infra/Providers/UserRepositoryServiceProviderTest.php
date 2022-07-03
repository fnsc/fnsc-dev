<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Domain\Contracts\UserRepository;
use Fnsc\Infra\Repositories\User;
use Illuminate\Foundation\Application;
use Tests\TestCase;

class UserRepositoryServiceProviderTest extends TestCase
{
    public function testShouldRegisterTheContractIntoTheFrameworkContainer(): void
    {
        // Set
        $app = new Application();
        $serviceProvider = new UserRepositoryServiceProvider($app);

        // Actions
        $serviceProvider->register();
        $repository = $this->app->make(UserRepository::class);

        // Assertions
        $this->assertInstanceOf(User::class, $repository);
    }

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
