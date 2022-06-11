<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Application\Contracts\Config as ConfigContract;
use Fnsc\Infra\Adapters\Config;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ConfigAdapterServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(ConfigContract::class, Config::class);
    }

    public function provides(): array
    {
        return [
            Config::class,
        ];
    }
}
