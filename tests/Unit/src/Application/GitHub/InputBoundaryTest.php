<?php

namespace Fnsc\Application\GitHub;

use PHPUnit\Framework\TestCase;

class InputBoundaryTest extends TestCase
{
    public function testShouldGetInputBoundaryInstance(): void
    {
        // Actions
        $input = new InputBoundary(
            login: 'johnDoe',
            profileUrl: 'https://github.com/johnDoe',
            email: 'johnDoe@github.com'
        );

        // Assertions
        $this->assertInstanceOf(InputBoundary::class, $input);
        $this->assertSame('johnDoe', $input->getLogin());
        $this->assertSame(
            'https://github.com/johnDoe',
            $input->getProfileUrl()
        );
        $this->assertSame('johnDoe@github.com', $input->getEmail());
    }
}
