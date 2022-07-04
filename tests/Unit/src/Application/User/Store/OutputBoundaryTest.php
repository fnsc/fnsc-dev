<?php

namespace Fnsc\Application\User\Store;

use Fnsc\Domain\Entities\User;
use PHPUnit\Framework\TestCase;

class OutputBoundaryTest extends TestCase
{
    public function testShouldGetOutputBoundaryInstance(): void
    {
        // Set
        $user = $this->createMock(User::class);

        // Actions
        $outputBoundary = new OutputBoundary($user);

        // Assertions
        $this->assertInstanceOf(OutputBoundary::class, $outputBoundary);
        $this->assertInstanceOf(
            User::class,
            $outputBoundary->getUser()
        );
    }
}
