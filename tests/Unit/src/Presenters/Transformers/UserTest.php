<?php

namespace Fnsc\Presenters\Transformers;

use Fnsc\Domain\Entities\User as UserEntity;
use Fnsc\Domain\ValueObjects\Url;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testShouldTransformUserEntity(): void
    {
        // Set
        $transformer = new User();

        $user = m::mock(UserEntity::class);
        $expected = [
            'name' => 'John Doe',
            'bio' => 'Lorem ipsum',
            'avatarUrl' => 'http://avatar.localhost/johnDoe.png',
            'location' => 'Vancouver, BC',
        ];

        // Expectations
        /** @phpstan-ignore-next-line  */
        $user->expects()
            ->getName()
            ->andReturn('John Doe');

        /** @phpstan-ignore-next-line  */
        $user->expects()
            ->getBio()
            ->andReturn('Lorem ipsum');

        /** @phpstan-ignore-next-line  */
        $user->expects()
            ->getAvatarUrl()
            ->andReturn(new Url('http://avatar.localhost/johnDoe.png'));

        /** @phpstan-ignore-next-line  */
        $user->expects()
            ->getLocation()
            ->andReturn('Vancouver, BC');

        // Actions
        /** @phpstan-ignore-next-line  */
        $result = $transformer->transform($user);

        // Assertions
        $this->assertSame($expected, $result);
    }
}
