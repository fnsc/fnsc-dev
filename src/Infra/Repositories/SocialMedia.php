<?php

namespace Fnsc\Infra\Repositories;

use DomainException;
use Fnsc\Domain\Contracts\SocialMediaRepository;
use Fnsc\Domain\Entities\SocialMedia as SocialMediaEntity;
use Fnsc\Domain\Entities\User as UserEntity;
use Fnsc\Infra\Models\Eloquent\SocialMedia as SocialMediaModel;
use MongoDB\BSON\ObjectId;

class SocialMedia implements SocialMediaRepository
{
    public function store(SocialMediaEntity $socialMedia, UserEntity $user): SocialMediaEntity
    {
        $socialMediaModel = $this->firstOrCreate($socialMedia->getId());

        if (!empty($socialMediaModel->getAttribute('id'))) {
            $this->setAttributes($socialMediaModel, $socialMedia, $user);
            $socialMediaModel->save();

            return $this->getSocialMediaEntity(
                $this->first($socialMediaModel->getAttribute('id'))
            );
        }

        $this->setAttributes($socialMediaModel, $socialMedia, $user);
        $socialMediaModel->setAttribute('id', $socialMedia->getId());
        $socialMediaModel->save();

        return $this->getSocialMediaEntity(
            $this->first($socialMedia->getId())
        );
    }

    /**
     * @param UserEntity $user
     * @return array|SocialMediaEntity[]
     */
    public function getUserSocialMedia(UserEntity $user): array
    {
        $socialMedia = [];
        /* @phpstan-ignore-next-line */
        $socialMediaCollection = SocialMediaModel::where(
            'user_id',
            $user->getId()
        )->get();

        foreach ($socialMediaCollection as $socialMediaModel) {
            $socialMedia[] = $this->getSocialMediaEntity($socialMediaModel);
        }

        return $socialMedia;
    }

    private function firstOrCreate(ObjectId $id): SocialMediaModel
    {
        /* @phpstan-ignore-next-line  */
        if ($socialMedia = SocialMediaModel::where('id', $id)->first()) {
            return $socialMedia;
        }

        return new SocialMediaModel();
    }

    private function setAttributes(
        SocialMediaModel $socialMediaModel,
        SocialMediaEntity $socialMediaEntity,
        UserEntity $userEntity
    ): void {
        $socialMediaModel->setAttribute('user_id', $userEntity->getId());
        $socialMediaModel->setAttribute('name', $socialMediaEntity->getName());
        $socialMediaModel->setAttribute(
            'profile_url',
            $socialMediaEntity->getProfileUrl()
        );
        $socialMediaModel->setAttribute(
            'username',
            $socialMediaEntity->getUsername()
        );
        $socialMediaModel->setAttribute(
            'icon_path',
            $socialMediaEntity->getIconPath()
        );
    }

    private function getSocialMediaEntity(SocialMediaModel $socialMediaModel): SocialMediaEntity
    {
        return SocialMediaEntity::getNewSocialMedia(
            $socialMediaModel->getAttribute('name'),
            $socialMediaModel->getAttribute('username'),
            $socialMediaModel->getAttribute('profile_url'),
            $socialMediaModel->getAttribute('icon_path'),
            $socialMediaModel->getAttribute('id'),
        );
    }

    private function first(ObjectId $id): SocialMediaModel
    {
        /* @phpstan-ignore-next-line */
        if (!$socialMedia = SocialMediaModel::where('id', $id)->first()) {
            throw new DomainException('not found');
        }

        return $socialMedia;
    }
}
