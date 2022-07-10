<?php

namespace Fnsc\Domain\Exceptions;

use DomainException;

final class User extends DomainException
{
    public static function invalidEmail(): self
    {
        return new self('Invalid email provided.');
    }

    public static function invalidUrl(): self
    {
        return new self('Invalid url provided.');
    }

    public static function notFound(): self
    {
        return new self('User not found.');
    }
}
