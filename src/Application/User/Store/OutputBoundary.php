<?php

namespace Fnsc\Application\User\Store;

use Fnsc\Domain\Entities\User;

class OutputBoundary
{
    public function __construct(private readonly User $user)
    {
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
