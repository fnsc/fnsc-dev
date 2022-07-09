<?php

namespace Fnsc\Application\Contracts;

interface UrlGenerator
{
    public function asset(string $url, string $query = ''): string;
}
