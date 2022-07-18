<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Domain\Contracts\ExperienceRepository;
use Fnsc\Infra\Repositories\Experience;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ExperienceRepositoryServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(
            ExperienceRepository::class,
            Experience::class
        );
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return [
            ExperienceRepository::class,
        ];
    }
}
