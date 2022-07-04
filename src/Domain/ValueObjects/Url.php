<?php

namespace Fnsc\Domain\ValueObjects;

use Fnsc\Domain\Exceptions\User as UserException;
use Stringable;

class Url implements Stringable
{
    public function __construct(private readonly string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw UserException::invalidUrl();
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->url;
    }
}
