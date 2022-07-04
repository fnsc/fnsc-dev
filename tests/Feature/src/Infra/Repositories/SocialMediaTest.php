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
        /** @phpstan-ignore-next-line */
        $user = UserModel::factory()->create([
            'id' => (string) new ObjectId('62c1eb78f0dc65e8d4063cc0'),
        ])->first();

        $user = UserEntity::getNewUser(
            /** @phpstan-ignore-next-line */
            $user->getAttribute('name'),
            /** @phpstan-ignore-next-line */
            $user->getAttribute('avatar_url'),
            /** @phpstan-ignore-next-line */
            $user->getAttribute('location'),
            /** @phpstan-ignore-next-line */
            $user->getAttribute('bio'),
            /** @phpstan-ignore-next-line */
            $user->getAttribute('email'),
            /** @phpstan-ignore-next-line */
            (string) $user->getAttribute('id')
        );

        $socialMedia = SocialMediaEntity::getNewSocialMedia(
            'GitHub',
            'johnDoe',
            'https://github.com/johnDoe',
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
        /** @phpstan-ignore-next-line */
        $user = UserModel::factory()->create([
            'id' => (string) new ObjectId('62c1eb78f0dc65e8d4063cc0'),
        ])->first();

        SocialMediaModel::factory()->create([
            'name' => 'GitHub',
            'username' => 'johnDoe',
            'profile_url' => 'https://github.com/johnDoe',
            'icon_path' => 'img/social/github.svg',
            'id' => '62c1e86b564afba894002110',
        ]);

        $user = UserEntity::getNewUser(
            /** @phpstan-ignore-next-line */
            $user->getAttribute('name'),
            /** @phpstan-ignore-next-line */
            $user->getAttribute('avatar_url'),
            /** @phpstan-ignore-next-line */
            $user->getAttribute('location'),
            /** @phpstan-ignore-next-line */
            $user->getAttribute('bio'),
            /** @phpstan-ignore-next-line */
            $user->getAttribute('email'),
            /** @phpstan-ignore-next-line */
            (string) $user->getAttribute('id')
        );

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
}
