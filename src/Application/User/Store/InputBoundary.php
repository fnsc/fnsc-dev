<?php

namespace Fnsc\Application\User\Store;

use stdClass;

class InputBoundary
{
    private function __construct(
        private readonly string $name,
        private readonly string $avatarUrl,
        private readonly string $location,
        private readonly string $bio,
        private readonly string $email
    ) {
    }

    public static function getInput(stdClass $gitHubUser): self
    {
        return new self(
            $gitHubUser->name,
            $gitHubUser->avatar_url,
            $gitHubUser->location,
            $gitHubUser->bio,
            $gitHubUser->email,
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
