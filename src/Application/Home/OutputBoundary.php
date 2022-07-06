<?php

namespace Fnsc\Application\Home;

use Fnsc\Domain\Entities\SocialMedia;
use Fnsc\Domain\Entities\User;

class OutputBoundary
{
    /**
     * @param User                  $user
     * @param SocialMedia[]         $socialMedia
     * @param array<string, string> $baseViewVars
     */
    public function __construct(
        private readonly User $user,
        private readonly array $socialMedia,
        private readonly array $baseViewVars
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

    /**
     * @return array<string, string>
     */
    public function getBaseViewVars(): array
    {
        return $this->baseViewVars;
    }
}
