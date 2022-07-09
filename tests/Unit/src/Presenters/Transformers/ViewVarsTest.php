<?php

namespace Fnsc\Presenters\Transformers;

use Fnsc\Application\Contracts\UrlGenerator;
use Fnsc\Domain\ValueObjects\ViewVars as ViewVarsValueObject;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class ViewVarsTest extends TestCase
{
    public function testShouldTransformViewVars(): void
    {
        // Set
        $urlGenerator = m::mock(UrlGenerator::class);
        /** @phpstan-ignore-next-line  */
        $transformer = new ViewVars($urlGenerator);

        $viewVars = m::mock(ViewVarsValueObject::class);

        $icons = [
            'heart' => [
                'name' => 'heart',
                'url' => 'http://localhost/img/heart.svg#heart',
            ],
        ];

        $expected = [
            'title' => 'John Doe',
            'location' => 'Home',
            'author' => 'John Doe',
            'description' => 'Lorem ipsum',
            'icons' => $icons,
            'keywords' => 'lorem, ipsum, dolor',
            'themeColor' => '#fff',
        ];

        // Expectations
        /** @phpstan-ignore-next-line  */
        $viewVars->expects()
            ->getTitle()
            ->andReturn('John Doe');

        /** @phpstan-ignore-next-line  */
        $viewVars->expects()
            ->getLocation()
            ->andReturn('Home');

        /** @phpstan-ignore-next-line  */
        $viewVars->expects()
            ->getAuthor()
            ->andReturn('John Doe');

        /** @phpstan-ignore-next-line  */
        $viewVars->expects()
            ->getDescription()
            ->andReturn('Lorem ipsum');

        /** @phpstan-ignore-next-line  */
        $viewVars->expects()
            ->getIcons()
            ->andReturn([
                'heart' => [
                    'path' => 'img/heart.svg#heart',
                ],
            ]);

        /** @phpstan-ignore-next-line  */
        $urlGenerator->expects()
            ->asset('img/heart.svg#heart')
            ->andReturn('http://localhost/img/heart.svg#heart');

        /** @phpstan-ignore-next-line  */
        $viewVars->expects()
            ->getKeywords()
            ->andReturn('lorem, ipsum, dolor');

        /** @phpstan-ignore-next-line  */
        $viewVars->expects()
            ->getThemeColor()
            ->andReturn('#fff');

        // Actions
        /** @phpstan-ignore-next-line  */
        $result = $transformer->transform($viewVars);

        // Assertions
        $this->assertSame($expected, $result);
    }
}
