<?php

namespace Fnsc\Application\GitHub;

use Fnsc\Domain\Entities\SocialMedia;
use PHPUnit\Framework\TestCase;

class OutputBoundaryTest extends TestCase
{
    public function testShouldGetOutputBoundaryInstance(): void
    {
        // Set
        $socialMedia = $this->createMock(SocialMedia::class);

        // Actions
        $outputBoundary = new OutputBoundary($socialMedia);

        // Assertions
        $this->assertInstanceOf(OutputBoundary::class, $outputBoundary);
        $this->assertInstanceOf(
            SocialMedia::class,
            $outputBoundary->getSocialMedia()
        );
    }
}
