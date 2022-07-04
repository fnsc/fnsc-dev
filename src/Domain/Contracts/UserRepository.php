<?php

namespace Fnsc\Domain\Contracts;

use Fnsc\Domain\Entities\User;
use Fnsc\Domain\ValueObjects\Email;

interface UserRepository
{
    /**
     * @param User $user
     * @return User
     */
    public function store(User $user): User;

    /**
     * @param Email $email
     * @return User
     */
    public function findByEmail(Email $email): User;
}
