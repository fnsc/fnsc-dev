<?php

namespace Tests\Feature\Fnsc\Infra\Repositories;

use Fnsc\Domain\Entities\SocialMedia as SocialMediaEntity;
use Fnsc\Domain\Entities\User as UserEntity;
use Fnsc\Infra\Models\Eloquent\SocialMedia as SocialMediaModel;
use Fnsc\Infra\Models\Eloquent\User as UserModel;
use Fnsc\Infra\Repositories\SocialMedia;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MongoDB\BSON\ObjectId;
use Tests\TestCase;

class SocialMediaTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function testShouldStoreNewSocialMedia(): void
    {
        // Set
        $user = $this->getUser();
        $user = $this->getUserEntity($user);
        $socialMedia = $this->getSocialMediaEntity();

        $repository = new SocialMedia();

        // Actions
        $result = $repository->store($socialMedia, $user);

        // Assertions
        $this->assertInstanceOf(SocialMediaEntity::class, $result);
        $this->assertSame(
            '62c1e86b564afba894002110',
            (string) $result->getId()
        );
        $this->assertSame('GitHub', $result->getName());
        $this->assertSame('johnDoe', $result->getUsername());
        $this->assertSame('img/social/github.svg', $result->getIconPath());
        $this->assertSame(
            'https://github.com/johnDoe',
            (string) $result->getProfileUrl()
        );
    }

    public function testShouldUpdateSocialMediaThatAlreadyExists(): void
    {
        // Set
        $user = $this->getUser();
        $user = $this->getUserEntity($user);
        $this->storeSocialMedia();
        $socialMedia = SocialMediaEntity::getNewSocialMedia(
            'GitHub',
            'johnDoe1',
            'https://github.com/johnDoe1',
            'img/social/github.svg',
            '62c1e86b564afba894002110'
        );

        $repository = new SocialMedia();

        // Actions
        $result = $repository->store($socialMedia, $user);

        // Assertions
        $this->assertInstanceOf(SocialMediaEntity::class, $result);
        $this->assertSame(
            '62c1e86b564afba894002110',
            (string) $result->getId()
        );
        $this->assertSame('GitHub', $result->getName());
        $this->assertSame('johnDoe1', $result->getUsername());
        $this->assertSame('img/social/github.svg', $result->getIconPath());
        $this->assertSame(
            'https://github.com/johnDoe1',
            (string) $result->getProfileUrl()
        );
    }

    public function testShouldGetUserSocialMedia(): void
    {
        // Set
        $user = $this->getUser();
        $user = $this->getUserEntity($user);
        $this->storeSocialMedia();

        $repository = new SocialMedia();

        // Actions
        $result = $repository->getUserSocialMedia($user);

        // Assertions
        $this->assertInstanceOf(SocialMediaEntity::class, current($result));
    }

    private function getUser(): mixed
    {
        /** @phpstan-ignore-next-line */
        return UserModel::factory()->create([
            'id' => (string) new ObjectId('62c1eb78f0dc65e8d4063cc0'),
        ])->first();
    }

    private function getUserEntity(UserModel $user): UserEntity
    {
        return UserEntity::getNewUser(
            $user->getAttribute('name'),
            $user->getAttribute('avatar_url'),
            $user->getAttribute('location'),
            $user->getAttribute('bio'),
            $user->getAttribute('email'),
            (string) $user->getAttribute('id')
        );
    }

    private function getSocialMediaEntity(): SocialMediaEntity
    {
        return SocialMediaEntity::getNewSocialMedia(
            'GitHub',
            'johnDoe',
            'https://github.com/johnDoe',
            'img/social/github.svg',
            '62c1e86b564afba894002110'
        );
    }

    private function storeSocialMedia(): void
    {
        SocialMediaModel::factory()->create([
            'name' => 'GitHub',
            'username' => 'johnDoe',
            'profile_url' => 'https://github.com/johnDoe',
            'icon_path' => 'img/social/github.svg',
            'id' => '62c1e86b564afba894002110',
        ]);
    }
}
