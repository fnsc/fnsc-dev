<?php

namespace Fnsc\Infra\Adapters;

use Fnsc\Application\Contracts\Config as ConfigContract;
use Illuminate\Contracts\Routing\UrlGenerator as IlluminateUrlGenerator;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class UrlGeneratorTest extends TestCase
{
    public function testShouldGetLocalAssetUrl(): void
    {
        // Set
        $generator = m::mock(IlluminateUrlGenerator::class);
        $config = m::mock(ConfigContract::class);
        /** @phpstan-ignore-next-line  */
        $urlGenerator = new UrlGenerator($generator, $config);

        // Expectations
        /** @phpstan-ignore-next-line  */
        $config->expects()
            ->get('app.env')
            ->andReturn('local');

        /** @phpstan-ignore-next-line  */
        $generator->expects()
            ->asset('img/orkut.svg#orkut')
            ->andReturn('http://localhost:8080/img/orkut.svg#orkut');

        // Actions
        $result = $urlGenerator->asset('img/orkut.svg#orkut');

        // Assertions
        $this->assertSame(
            'http://localhost:8080/img/orkut.svg#orkut',
            $result
        );
    }

    public function testShouldGetProductionAssetUrl(): void
    {
        // Set
        $generator = m::mock(IlluminateUrlGenerator::class);
        $config = m::mock(ConfigContract::class);
        /** @phpstan-ignore-next-line  */
        $urlGenerator = new UrlGenerator($generator, $config);

        // Expectations
        /** @phpstan-ignore-next-line  */
        $config->expects()
            ->get('app.env')
            ->andReturn('production');

        /** @phpstan-ignore-next-line  */
        $generator->expects()
            ->asset('img/orkut.svg#orkut', true)
            ->andReturn('https://localhost:8080/img/orkut.svg#orkut');

        // Actions
        $result = $urlGenerator->asset('img/orkut.svg#orkut');

        // Assertions
        $this->assertSame(
            'https://localhost:8080/img/orkut.svg#orkut',
            $result
        );
    }
}
