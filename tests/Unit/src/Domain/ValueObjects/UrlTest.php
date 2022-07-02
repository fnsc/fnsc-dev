<?php

namespace Fnsc\Domain\ValueObjects;

use Fnsc\Domain\Exceptions\User;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function testShouldGetAnUrlInstance(): void
    {
        // Actions
        $result = new Url('https://github.com');

        // Assertions
        $this->assertInstanceOf(Url::class, $result);
        $this->assertSame('https://github.com', (string) $result);
    }

    public function testShouldThrowAnExceptionWhenInvalidUrlProvided(): void
    {
        // Expectations
        $this->expectException(User::class);
        $this->expectExceptionMessage('Invalid url provided.');

        // Actions
        new Url('http;/asdasd//.com');
    }
}
