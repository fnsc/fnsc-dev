<?php

namespace Fnsc\Application\Contracts;

interface Config
{
    /**
     * @param string $config
     * @return mixed
     */
    public function get(string $config): mixed;
}
