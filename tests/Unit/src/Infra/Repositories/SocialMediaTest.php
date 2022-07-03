<?php

namespace Fnsc\Infra\Repositories;

use Fnsc\Domain\Entities\SocialMedia as SocialMediaEntity;
use Fnsc\Domain\Entities\User as UserEntity;
use Fnsc\Domain\ValueObjects\Url;
use Fnsc\Infra\Models\Eloquent\SocialMedia as SocialMediaModel;
use Fnsc\Infra\Models\Eloquent\User as UserModel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;
use MongoDB\BSON\ObjectId;
use Tests\TestCase;

class SocialMediaTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function testShouldStoreNewSocialMedia(): void
    {
        // Set
        $userId = new ObjectId('62c1eb78f0dc65e8d4063cc0');
        UserModel::factory()->create(['id' => (string) $userId]);
        $repository = new SocialMedia();

        $user = m::mock(UserEntity::class);
        $socialMedia = m::mock(SocialMediaEntity::class);
        $objectId = new ObjectId('62c1e86b564afba894002110');

        $socialMediaModel = $this->instance(
            SocialMediaModel::class,
            m::mock(SocialMediaModel::class)
        );

        // Expectations
        /** @phpstan-ignore-next-line */
        $socialMedia->expects()
            ->getId()
            ->times(3)
            ->andReturn($objectId);

        /** @phpstan-ignore-next-line */
        $socialMediaModel->shouldReceive('where')
            ->with('id', $objectId)
            ->andReturnSelf();

        /** @phpstan-ignore-next-line */
        $user->expects()
            ->getId()
            ->andReturn($userId);

        /** @phpstan-ignore-next-line */
        $socialMedia->expects()
            ->getName()
            ->andReturn('GitHub');

        /** @phpstan-ignore-next-line */
        $socialMedia->expects()
            ->getProfileUrl()
            ->andReturn(new Url('https://github.com/johnDoe'));

        /** @phpstan-ignore-next-line */
        $socialMedia->expects()
            ->getUsername()
            ->andReturn('johnDoe');

        /** @phpstan-ignore-next-line */
        $socialMedia->expects()
            ->getIconPath()
            ->andReturn('img/social/github.svg');

        // Actions
        /** @phpstan-ignore-next-line */
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
}
