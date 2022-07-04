<?php

namespace Fnsc\Application\Home;

use Fnsc\Domain\Entities\SocialMedia;
use Fnsc\Domain\Entities\User;

class OutputBoundary
{
    /**
     * @param User          $user
     * @param SocialMedia[] $socialMedia
     */
    public function __construct(
        private readonly User $user,
        private readonly array $socialMedia
    ) {
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return SocialMedia[]
     */
    public function getSocialMedia(): array
    {
        return $this->socialMedia;
    }
}
