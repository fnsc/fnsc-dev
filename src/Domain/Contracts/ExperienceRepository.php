<?php

namespace Fnsc\Domain\Contracts;

use Fnsc\Domain\Entities\Experience;
use Fnsc\Domain\Entities\User;

interface ExperienceRepository
{
    /**
     * @param Experience $experience
     * @param User       $user
     * @return Experience
     */
    public function store(Experience $experience, User $user): Experience;
}
