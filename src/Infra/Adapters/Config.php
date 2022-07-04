<?php

namespace Fnsc\Infra\Adapters;

use Fnsc\Application\Contracts\Config as ConfigContract;
use Illuminate\Config\Repository;

class Config implements ConfigContract
{
    public function __construct(private readonly Repository $config)
    {
    }

    public function get(string $config): mixed
    {
        return $this->config->get($config);
    }
}
