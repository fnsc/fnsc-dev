<?php

namespace Fnsc\Application\Experience\Store;

use Fnsc\Domain\Entities\Experience;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class OutputBoundaryTest extends TestCase
{
    public function testShouldGetAnOutputBoundaryInstance(): void
    {
        // Set
        $experience = m::mock(Experience::class);

        // Actions
        /** @phpstan-ignore-next-line */
        $result = new OutputBoundary($experience);

        // Assertions
        $this->assertInstanceOf(Experience::class, $result->getExperience());
    }
}
