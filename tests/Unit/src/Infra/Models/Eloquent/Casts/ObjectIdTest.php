<?php

namespace Fnsc\Infra\Models\Eloquent\Casts;

use Fnsc\Infra\Models\Eloquent\User;
use MongoDB\BSON\ObjectId as MongoObjectId;
use PHPUnit\Framework\TestCase;

class ObjectIdTest extends TestCase
{
    public function testShouldGetTheEmailAttributeWhenValueIsValid(): void
    {
        // Set
        $emailCast = new ObjectId();

        // Actions
        $result = $emailCast->get(
            new User(),
            'id',
            '62c1dab3015bf4f4570d6580',
            []
        );

        // Assertions
        $this->assertInstanceOf(MongoObjectId::class, $result);
        $this->assertSame('62c1dab3015bf4f4570d6580', (string) $result);
    }

    public function testShouldReturnNullWhenValueIsEmpty(): void
    {
        // Set
        $emailCast = new ObjectId();

        // Actions
        $result = $emailCast->get(new User(), 'id', '', []);

        // Assertions
        $this->assertNull($result);
    }

    public function testShouldSetTheEmailAttributeWhenValueIsValid(): void
    {
        // Set
        $emailCast = new ObjectId();

        // Actions
        $result = $emailCast->set(
            new User(),
            'id',
            new MongoObjectId('62c1dab3015bf4f4570d6580'),
            []
        );

        // Assertions
        $this->assertSame('62c1dab3015bf4f4570d6580', $result);
    }
}
