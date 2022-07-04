<?php

namespace Fnsc\Infra\Models\Eloquent\Casts;

use Fnsc\Domain\ValueObjects\Email as EmailValueObject;
use Fnsc\Infra\Models\Eloquent\User;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testShouldGetTheEmailAttributeWhenValueIsValid(): void
    {
        // Set
        $emailCast = new Email();

        // Actions
        $result = $emailCast->get(
            new User(),
            'email',
            'johnDoe@github.com',
            []
        );

        // Assertions
        $this->assertInstanceOf(EmailValueObject::class, $result);
        $this->assertSame('johnDoe@github.com', (string) $result);
    }

    public function testShouldReturnNullWhenValueIsEmpty(): void
    {
        // Set
        $emailCast = new Email();

        // Actions
        $result = $emailCast->get(new User(), 'email', '', []);

        // Assertions
        $this->assertNull($result);
    }

    public function testShouldSetTheEmailAttributeWhenValueIsValid(): void
    {
        // Set
        $emailCast = new Email();

        // Actions
        $result = $emailCast->set(
            new User(),
            'email',
            new EmailValueObject('johnDoe@github.com'),
            []
        );

        // Assertions
        $this->assertSame('johnDoe@github.com', $result);
    }
}
