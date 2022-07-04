<?php

namespace Fnsc\Presenters\Transformers;

use Fnsc\Domain\Entities\User as UserEntity;

class User
{
    /**
     * @param UserEntity $user
     * @return array<string, string>
     */
    public function transform(UserEntity $user): array
    {
        return [
            'name' => $user->getName(),
            'bio' => $user->getBio(),
            'avatarUrl' => $user->getAvatarUrl(),
            'location' => $user->getLocation(),
        ];
    }
}
