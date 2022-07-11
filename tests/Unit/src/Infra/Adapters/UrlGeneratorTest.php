<?php

namespace Fnsc\Infra\Adapters;

use Illuminate\Contracts\Routing\UrlGenerator as IlluminateUrlGenerator;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class UrlGeneratorTest extends TestCase
{
    public function testShouldGetLocalAssetUrl(): void
    {
        // Set
        $generator = m::mock(IlluminateUrlGenerator::class);
        /** @phpstan-ignore-next-line  */
        $urlGenerator = new UrlGenerator($generator);

        // Expectations
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
}
