<?php

namespace Fnsc\Domain\Exceptions;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testShouldGetUserExceptionWhenInvalidEmail(): void
    {
        // Actions
        $result = User::invalidEmail();

        // Assertions
        $this->assertInstanceOf(User::class, $result);
        $this->assertSame('Invalid email provided.', $result->getMessage());
    }

    public function testShouldGetUserExceptionWhenInvalidUrl(): void
    {
        // Actions
        $result = User::invalidUrl();

        // Assertions
        $this->assertInstanceOf(User::class, $result);
        $this->assertSame('Invalid url provided.', $result->getMessage());
    }

    public function testShouldGetUserExceptionWhenUserNotFound(): void
    {
        // Actions
        $result = User::notFound();

        // Assertions
        $this->assertInstanceOf(User::class, $result);
        $this->assertSame('User not found.', $result->getMessage());
    }
}
