<?php

namespace Fnsc\Infra\Models\Eloquent;

use Database\Factories\UserFactory;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testShouldGetUserFactory(): void
    {
        // Set
        $user = new User();

        // Actions
        $result = $user::factory();

        // Assertions
        $this->assertInstanceOf(UserFactory::class, $result);
    }
}
