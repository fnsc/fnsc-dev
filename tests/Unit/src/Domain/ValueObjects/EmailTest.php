<?php

namespace Fnsc\Domain\ValueObjects;

use Fnsc\Domain\Exceptions\User;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testShouldGetEmailInstance(): void
    {
        // Actions
        $result = new Email('johnDoe@github.com');

        // Assertions
        $this->assertInstanceOf(Email::class, $result);
        $this->assertSame('johnDoe@github.com', (string) $result);
    }

    public function testShouldThrowAnExceptionWhenInvalidEmailProvided(): void
    {
        // Expectations
        $this->expectExceptionMessage('Invalid email provided.');
        $this->expectException(User::class);

        // Actions
        new Email('johnDoe#.com');
    }
}
