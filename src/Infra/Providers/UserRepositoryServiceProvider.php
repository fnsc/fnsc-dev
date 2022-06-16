<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Domain\Contracts\UserRepository as UserRepositoryContract;
use Fnsc\Infra\Repositories\User as UserRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class UserRepositoryServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return [
            UserRepository::class,
        ];
    }
}
