<?php

namespace Fnsc\Application\GitHub;

class InputBoundary
{
    public function __construct(
        private readonly string $login,
        private readonly string $profileUrl,
        private readonly string $email
    ) {
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getProfileUrl(): string
    {
        return $this->profileUrl;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
