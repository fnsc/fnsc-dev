<?php

namespace Fnsc\Infra\Models\Eloquent\Casts;

use Fnsc\Domain\ValueObjects\Url as UrlValueObject;
use Fnsc\Infra\Models\Eloquent\User;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function testShouldGetTheEmailAttributeWhenValueIsValid(): void
    {
        // Set
        $emailCast = new Url();

        // Actions
        $result = $emailCast->get(
            new User(),
            'avatar_url',
            'https://github.com',
            []
        );

        // Assertions
        $this->assertInstanceOf(UrlValueObject::class, $result);
        $this->assertSame('https://github.com', (string) $result);
    }

    public function testShouldReturnNullWhenValueIsEmpty(): void
    {
        // Set
        $emailCast = new Url();

        // Actions
        $result = $emailCast->get(new User(), 'avatar_url', '', []);

        // Assertions
        $this->assertNull($result);
    }

    public function testShouldSetTheEmailAttributeWhenValueIsValid(): void
    {
        // Set
        $emailCast = new Url();

        // Actions
        $result = $emailCast->set(
            new User(),
            'avatar_url',
            new UrlValueObject('https://github.com'),
            []
        );

        // Assertions
        $this->assertSame('https://github.com', $result);
    }
}
