<?php

namespace Fnsc\Application\User\Store;

use Fnsc\Domain\Contracts\UserRepository;
use Fnsc\Domain\Entities\User;

class Service
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function handle(InputBoundary $input): OutputBoundary
    {
        $user = $this->getUser($input);
        $result = $this->userRepository->store($user);

        return new OutputBoundary($result);
    }

    private function getUser(InputBoundary $input): User
    {
        return User::getNewUser(
            $input->getName(),
            $input->getAvatarUrl(),
            $input->getLocation(),
            $input->getBio(),
            $input->getEmail(),
        );
    }
}
