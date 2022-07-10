<?php

namespace Fnsc\Presenters\Transformers\Home;

use Fnsc\Application\Home\OutputBoundary;
use Fnsc\Domain\Entities\SocialMedia as SocialMediaEntity;
use Fnsc\Domain\Entities\User as UserEntity;
use Fnsc\Domain\ValueObjects\ViewVars as ViewVarsValueObject;
use Fnsc\Presenters\Transformers\SocialMedia;
use Fnsc\Presenters\Transformers\User;
use Fnsc\Presenters\Transformers\ViewVars;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class TransformerTest extends TestCase
{
    public function testShouldTransformOutputBoundaryObject(): void
    {
        // Set
        $socialMediaTransformer = m::mock(SocialMedia::class);
        $userTransformer = m::mock(User::class);
        $viewVarsTransformer = m::mock(ViewVars::class);
        $transformer = new Transformer(
            /** @phpstan-ignore-next-line  */
            $socialMediaTransformer,
            /** @phpstan-ignore-next-line  */
            $userTransformer,
            /** @phpstan-ignore-next-line  */
            $viewVarsTransformer
        );

        $output = m::mock(OutputBoundary::class);
        $userEntity = m::mock(UserEntity::class);
        $socialMediaEntity = m::mock(SocialMediaEntity::class);
        $viewVarsValueObject = m::mock(ViewVarsValueObject::class);

        $expected = [
            'title' => 'John Doe',
            'location' => 'Home',
            'author' => 'John Doe',
            'description' => 'Lorem ipsum',
            'icons' => [
                'heart' => [
                    'name' => 'heart',
                    'url' => 'http://localhost/img/heart.svg#heart',
                ],
            ],
            'keywords' => 'lorem, ipsum, dolor',
            'themeColor' => '#fff',
            'user' => [
                'name' => 'John Doe',
                'bio' => 'Lorem ipsum',
                'avatarUrl' => 'http://avatar.localhost/johnDoe.png',
                'location' => 'Vancouver, BC',
            ],
            'socialMedia' => [
                [
                    'id' => '62ca17297aea908c47063e30',
                    'name' => 'Orkut',
                    'iconPath' => 'http://localhost/img/social/orkut.svg#orkut',
                    'profileUrl' => 'https://orkut.com/johnDoe',
                ],
            ],
        ];

        // Expectations
        /** @phpstan-ignore-next-line  */
        $output->expects()
            ->getUser()
            ->andReturn($userEntity);

        /** @phpstan-ignore-next-line  */
        $userTransformer->expects()
            ->transform($userEntity)
            ->andReturn([
                'name' => 'John Doe',
                'bio' => 'Lorem ipsum',
                'avatarUrl' => 'http://avatar.localhost/johnDoe.png',
                'location' => 'Vancouver, BC',
            ]);

        /** @phpstan-ignore-next-line  */
        $output->expects()
            ->getSocialMedia()
            ->andReturn([$socialMediaEntity]);

        /** @phpstan-ignore-next-line  */
        $socialMediaTransformer->expects()
            ->transform($socialMediaEntity)
            ->andReturn([
                'id' => '62ca17297aea908c47063e30',
                'name' => 'Orkut',
                'iconPath' => 'http://localhost/img/social/orkut.svg#orkut',
                'profileUrl' => 'https://orkut.com/johnDoe',
            ]);

        /** @phpstan-ignore-next-line  */
        $output->expects()
            ->getBaseViewVars()
            ->andReturn($viewVarsValueObject);

        /** @phpstan-ignore-next-line  */
        $viewVarsTransformer->expects()
            ->transform($viewVarsValueObject)
            ->andReturn([
                'title' => 'John Doe',
                'location' => 'Home',
                'author' => 'John Doe',
                'description' => 'Lorem ipsum',
                'icons' => [
                    'heart' => [
                        'name' => 'heart',
                        'url' => 'http://localhost/img/heart.svg#heart',
                    ],
                ],
                'keywords' => 'lorem, ipsum, dolor',
                'themeColor' => '#fff',
            ]);

        // Actions
        /** @phpstan-ignore-next-line  */
        $result = $transformer->transform($output);

        // Assertions
        $this->assertSame($expected, $result);
    }
}
