<?php

namespace Fnsc\Infra\Adapters;

use Fnsc\Application\Contracts\UrlGenerator as UrlGeneratorContract;
use Illuminate\Contracts\Routing\UrlGenerator as IlluminateUrlGenerator;

class UrlGenerator implements UrlGeneratorContract
{
    public function __construct(
        private readonly IlluminateUrlGenerator $generator
    ) {
    }

    public function asset(string $url, string $query = ''): string
    {
        return $this->generator->asset($url) . $query;
    }
}
