<?php

namespace Fnsc\Application\User\Store;

use Fnsc\Domain\Contracts\UserRepository;
use Fnsc\Domain\Entities\User as UserEntity;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function testShouldHandle(): void
    {
        // Set
        $userRepository = $this->createMock(UserRepository::class);
        $service = m::mock(Service::class . '[getUser]', [$userRepository]);
        $service->shouldAllowMockingProtectedMethods();

        $user = UserEntity::getNewUser(
            'John Doe',
            'https://avatar.github.com/johnDoe',
            'Vancouver, BC - Canada',
            'Lorem Ipsum',
            'johnDoe@github.com',
            '62c09129541775b51b021d90'
        );
        $input = m::mock(InputBoundary::class);

        // Expectations
        /** @phpstan-ignore-next-line  */
        $service->expects('getUser')
            ->once()
            ->andReturn($user);

        $userRepository->expects($this->once())
            ->method('store')
            ->with($user)
            ->willReturn(m::mock(UserEntity::class));

        // Actions
        /** @phpstan-ignore-next-line  */
        $result = $service->handle($input);

        // Assertions
        $this->assertInstanceOf(OutputBoundary::class, $result);
    }
}
