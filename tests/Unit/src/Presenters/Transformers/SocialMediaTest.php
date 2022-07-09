<?php

namespace Fnsc\Presenters\Transformers;

use Fnsc\Application\Contracts\UrlGenerator;
use Fnsc\Domain\Entities\SocialMedia as SocialMediaEntity;
use Fnsc\Domain\ValueObjects\Url;
use Mockery as m;
use MongoDB\BSON\ObjectId;
use PHPUnit\Framework\TestCase;

class SocialMediaTest extends TestCase
{
    public function testShouldTransformSocialMediaEntity(): void
    {
        // Set
        $urlGenerator = m::mock(UrlGenerator::class);
        /** @phpstan-ignore-next-line  */
        $transformer = new SocialMedia($urlGenerator);

        $socialMedia = m::mock(SocialMediaEntity::class);
        $expected = [
            'id' => '62ca17297aea908c47063e30',
            'name' => 'Orkut',
            'iconPath' => 'http://localhost/img/social/orkut.svg#orkut',
            'profileUrl' => 'https://orkut.com/johnDoe',
        ];

        // Expectations
        /** @phpstan-ignore-next-line  */
        $socialMedia->expects()
            ->getId()
            ->andReturn(new ObjectId('62ca17297aea908c47063e30'));

        /** @phpstan-ignore-next-line  */
        $socialMedia->expects()
            ->getName()
            ->andReturn('Orkut');

        /** @phpstan-ignore-next-line  */
        $socialMedia->expects()
            ->getIconPath()
            ->andReturn('img/social/orkut.svg#orkut');

        /** @phpstan-ignore-next-line  */
        $urlGenerator->expects()
            ->asset('img/social/orkut.svg#orkut')
            ->andReturn('http://localhost/img/social/orkut.svg#orkut');

        /** @phpstan-ignore-next-line  */
        $socialMedia->expects()
            ->getProfileUrl()
            ->andReturn(new Url('https://orkut.com/johnDoe'));

        // Actions
        /** @phpstan-ignore-next-line  */
        $result = $transformer->transform($socialMedia);

        // Assertions
        $this->assertSame($expected, $result);
    }
}
