<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Domain\Contracts\SocialMediaRepository as SocialMediaRepositoryContract;
use Fnsc\Infra\Repositories\SocialMedia as SocialMediaRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class SocialMediaRepositoryServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            SocialMediaRepositoryContract::class,
            SocialMediaRepository::class
        );
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return [
            SocialMediaRepositoryContract::class,
        ];
    }
}
