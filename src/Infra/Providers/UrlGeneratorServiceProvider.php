<?php

namespace Fnsc\Infra\Providers;

use Fnsc\Application\Contracts\Config;
use Fnsc\Application\Contracts\UrlGenerator as UrlGeneratorContract;
use Fnsc\Infra\Adapters\UrlGenerator;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Routing\UrlGenerator as IlluminateUrlGenerator;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class UrlGeneratorServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(UrlGeneratorContract::class, function () {
            $generator = $this->app->make(IlluminateUrlGenerator::class);
            $config = $this->app->make(Config::class);

            return new UrlGenerator($generator, $config);
        });
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return [
            UrlGeneratorContract::class,
        ];
    }
}
