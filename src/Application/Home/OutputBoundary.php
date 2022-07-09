<?php

namespace Fnsc\Application\Home;

use Fnsc\Domain\Entities\SocialMedia;
use Fnsc\Domain\Entities\User;
use Fnsc\Domain\ValueObjects\ViewVars;

class OutputBoundary
{
    /**
     * @param User          $user
     * @param SocialMedia[] $socialMedia
     * @param ViewVars      $baseViewVars
     */
    public function __construct(
        private readonly User $user,
        private readonly array $socialMedia,
        private readonly ViewVars $baseViewVars
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

    public function getBaseViewVars(): ViewVars
    {
        return $this->baseViewVars;
    }
}
