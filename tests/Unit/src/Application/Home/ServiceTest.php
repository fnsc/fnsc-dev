<?php

namespace Fnsc\Application\Home;

use Fnsc\Application\Contracts\Config;
use Fnsc\Domain\Contracts\SocialMediaRepository;
use Fnsc\Domain\Contracts\UserRepository;
use Fnsc\Domain\Entities\SocialMedia;
use Fnsc\Domain\Entities\User;
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
        $service = new Service(
            $socialMediaRepository,
            $userRepository,
            /** @phpstan-ignore-next-line  */
            $config
        );

        // Expectations
        /** @phpstan-ignore-next-line  */
        $config->expects()
            ->get('user.authorized_user')
            ->andReturn('johnDoe@gmail.com');

        /** @phpstan-ignore-next-line  */
        $config->expects()
            ->get('user.social_media')
            ->andReturn([
                'orkut' => [
                    'name' => 'Orkut',
                    'icon_path' => 'img/social/orkut.svg',
                    'profile_url' => 'https://orkut.com/johnDoe',
                ],
            ]);

        /** @phpstan-ignore-next-line  */
        $config->expects()
            ->get('view.variables.home.themeColor')
            ->andReturn('#fff');

        /** @phpstan-ignore-next-line  */
        $config->expects()
            ->get('view.variables.home.keywords')
            ->andReturn('lorem, ipsum');

        /** @phpstan-ignore-next-line  */
        $config->expects()
            ->get('view.variables.home.icons')
            ->andReturn([
                'heart' => [
                    'path' => 'img/heart.svg#heart',
                ],
            ]);

        // Actions
        $result = $service->handle();

        // Assertions
        $this->assertInstanceOf(OutputBoundary::class, $result);
        $this->assertInstanceOf(User::class, $result->getUser());
        $this->assertInstanceOf(
            SocialMedia::class,
            current($result->getSocialMedia())
        );
    }
}
