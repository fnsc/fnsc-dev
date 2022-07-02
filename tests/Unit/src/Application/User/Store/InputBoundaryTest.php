<?php

namespace Fnsc\Application\User\Store;

use PHPUnit\Framework\TestCase;
use stdClass;

class InputBoundaryTest extends TestCase
{
    public function testShouldGetInputBoundaryInstance(): void
    {
        // Set
        $stdClass = new stdClass();
        $stdClass->name = 'John Doe';
        $stdClass->avatar_url = 'https://avatar.github.com/johnDoe';
        $stdClass->location = 'Vancouver, BC - Canada';
        $stdClass->bio = 'Lorem Ipsum';
        $stdClass->email = 'johnDoe@github.com';

        // Actions
        $result = InputBoundary::getInput($stdClass);

        // Assertions
        $this->assertInstanceOf(InputBoundary::class, $result);
        $this->assertSame('John Doe', $result->getName());
        $this->assertSame(
            'https://avatar.github.com/johnDoe',
            $result->getAvatarUrl()
        );
        $this->assertSame('Vancouver, BC - Canada', $result->getLocation());
        $this->assertSame('Lorem Ipsum', $result->getBio());
        $this->assertSame('johnDoe@github.com', $result->getEmail());
    }
}
