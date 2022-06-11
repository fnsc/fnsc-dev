<?php

namespace Fnsc\Application\Contracts;

interface Config
{
    public function get(string $config): mixed;
}
