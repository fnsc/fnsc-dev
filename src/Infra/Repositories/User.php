<?php

namespace Fnsc\Infra\Repositories;

use Fnsc\Domain\Contracts\UserRepository;
use Fnsc\Domain\Entities\User as UserEntity;
use Fnsc\Domain\Exceptions\User as UserException;
use Fnsc\Domain\ValueObjects\Email;
use Fnsc\Infra\Models\Eloquent\User as UserModel;
use MongoDB\BSON\ObjectId;

class User implements UserRepository
{
    public function store(UserEntity $user): UserEntity
    {
        $userModel = $this->firstOrCreate($user->getId());

        if (!empty($userModel->getAttribute('id'))) {
            $this->setAttributes($userModel, $user);
            $userModel->save();

            return $this->getUserEntity($userModel);
        }

        $this->setAttributes($userModel, $user);
        $userModel->setAttribute('id', $user->getId());
        $userModel->save();

        return $this->getUserEntity($this->first($user->getId()));
    }

    public function findByEmail(Email $email): UserEntity
    {
        /* @phpstan-ignore-next-line */
        if (!$userModel = UserModel::where('email', $email)->first()) {
            throw UserException::notFound();
        }

        return $this->getUserEntity($userModel);
    }

    private function firstOrCreate(ObjectId $id): UserModel
    {
        /* @phpstan-ignore-next-line */
        if ($user = UserModel::where('id', $id)->first()) {
            return $user;
        }

        return new UserModel();
    }

    private function getUserEntity(UserModel $userModel): UserEntity
    {
        return UserEntity::getNewUser(
            $userModel->getAttribute('name'),
            $userModel->getAttribute('avatar_url'),
            $userModel->getAttribute('location'),
            $userModel->getAttribute('bio'),
            $userModel->getAttribute('email'),
            $userModel->getAttribute('id'),
        );
    }

    private function setAttributes(UserModel $userModel, UserEntity $user): void
    {
        $userModel->setAttribute('name', $user->getName());
        $userModel->setAttribute('email', $user->getEmail());
        $userModel->setAttribute('avatar_url', $user->getAvatarUrl());
        $userModel->setAttribute('location', $user->getLocation());
        $userModel->setAttribute('bio', $user->getBio());
    }

    private function first(ObjectId $id): UserModel
    {
        /* @phpstan-ignore-next-line */
        if (!$user = UserModel::where('id', $id)->first()) {
            throw UserException::notFound();
        }

        return $user;
    }
}
