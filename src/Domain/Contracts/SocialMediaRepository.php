<?php

namespace Fnsc\Domain\Contracts;

use Fnsc\Domain\Entities\SocialMedia;
use Fnsc\Domain\Entities\User;

interface SocialMediaRepository
{
    public function store(SocialMedia $socialMedia, User $user): SocialMedia;
}
