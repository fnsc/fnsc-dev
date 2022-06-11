<?php

namespace Fnsc\Domain\Contracts;

use Fnsc\Domain\Entities\User;
use Fnsc\Domain\ValueObjects\Email;

interface UserRepository
{
    public function store(User $user): User;

    public function findByEmail(Email $email): User;
}
