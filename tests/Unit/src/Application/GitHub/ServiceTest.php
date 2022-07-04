<?php

namespace Fnsc\Application\GitHub;

use Fnsc\Application\Contracts\Config;
use Fnsc\Domain\Contracts\SocialMediaRepository;
use Fnsc\Domain\Contracts\UserRepository;
use Fnsc\Domain\Entities\SocialMedia as SocialMediaEntity;
use Fnsc\Domain\Entities\User as UserEntity;
use Fnsc\Domain\ValueObjects\Email;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function testShouldHandle(): void
    {
        // Set
        $socialMediaRepository = $this->createMock(
            SocialMediaRepository::class
        );
        $userRepository = $this->createMock(UserRepository::class);
        $config = m::mock(Config::class);
        $service = m::mock(Service::class . '[getSocialMedia]', [
            $socialMediaRepository, $userRepository, $config,
        ]);
        $service->shouldAllowMockingProtectedMethods();

        $user = m::mock(UserEntity::class);
        $socialMedia = SocialMediaEntity::getNewSocialMedia(
            'GitHub',
            'johnDoe',
            'https://github.com/johnDoe',
            'img/social/github.svg',
            '62c06dca8e9a302e83007af0'
        );
        $input = new InputBoundary(
            'johnDoe',
            'https://github.com/johnDoe',
            'johnDoe@github.com'
        );
        $email = new Email('johnDoe@github.com');

        // Expectations
        /** @phpstan-ignore-next-line  */
        $service->expects('getSocialMedia')
            ->once()
            ->andReturn($socialMedia);

        $userRepository->expects($this->once())
            ->method('findByEmail')
            ->with($email)
            ->willReturn($user);

        /** @phpstan-ignore-next-line  */
        $config->expects()
            ->get('user.social_media.github.name')
            ->andReturn('GitHub');

        /** @phpstan-ignore-next-line  */
        $config->expects()
            ->get('user.social_media.github.icon_path')
            ->andReturn('img/social/github.svg');

        $socialMediaRepository->expects($this->once())
            ->method('store')
            ->with($socialMedia, $user)
            ->willReturn(m::mock(SocialMediaEntity::class));

        // Actions
        /** @phpstan-ignore-next-line  */
        $result = $service->handle($input);

        // Assertions
        $this->assertInstanceOf(OutputBoundary::class, $result);
    }
}
