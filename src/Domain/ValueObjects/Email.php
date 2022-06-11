<?php

namespace Fnsc\Domain\ValueObjects;

use Fnsc\Domain\Exceptions\User as UserException;
use Stringable;

class Email implements Stringable
{
    public function __construct(private readonly string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw UserException::invalidEmail();
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }
}
