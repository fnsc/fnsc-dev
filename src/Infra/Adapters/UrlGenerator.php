<?php

namespace Fnsc\Infra\Adapters;

use Fnsc\Application\Contracts\Config as ConfigContract;
use Fnsc\Application\Contracts\UrlGenerator as UrlGeneratorContract;
use Illuminate\Contracts\Routing\UrlGenerator as IlluminateUrlGenerator;

class UrlGenerator implements UrlGeneratorContract
{
    private const LOCAL_ENVIRONMENT = 'local';

    public function __construct(
        private readonly IlluminateUrlGenerator $generator,
        private readonly ConfigContract $config
    ) {
    }

    public function asset(string $url, string $query = ''): string
    {
        return self::LOCAL_ENVIRONMENT === $this->config->get('app.env')
            ? $this->generator->asset($url) . $query
            : $this->generator->asset($url, true) . $query;
    }
}
