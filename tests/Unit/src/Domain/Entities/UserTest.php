<?php

namespace Fnsc\Domain\Entities;

use Fnsc\Domain\ValueObjects\Email;
use Fnsc\Domain\ValueObjects\Url;
use MongoDB\BSON\ObjectId;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testShouldGetUserEntityInstance(): void
    {
        // Actions
        $result = User::getNewUser(
            'John Doe',
            'https://avatar.github.com/johnDoe',
            'Vancouver, BC - Canada',
            'Lorem Ipsum',
            'johnDoe@github.com',
            '62c099719d621989ba0a8ff0'
        );

        // Assertions
        $this->assertInstanceOf(User::class, $result);
        $this->assertInstanceOf(Email::class, $result->getEmail());
        $this->assertInstanceOf(Url::class, $result->getAvatarUrl());
        $this->assertInstanceOf(ObjectId::class, $result->getId());
        $this->assertSame('John Doe', $result->getName());
        $this->assertSame('Vancouver, BC - Canada', $result->getLocation());
        $this->assertSame('Lorem Ipsum', $result->getBio());
        $this->assertSame('johnDoe@github.com', (string) $result->getEmail());
        $this->assertSame(
            'https://avatar.github.com/johnDoe',
            (string) $result->getAvatarUrl()
        );
        $this->assertSame(
            '62c099719d621989ba0a8ff0',
            (string) $result->getId()
        );
    }
}
