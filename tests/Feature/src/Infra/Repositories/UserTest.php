<?php

namespace Tests\Feature\Fnsc\Infra\Repositories;

use Fnsc\Domain\Entities\User as UserEntity;
use Fnsc\Domain\Exceptions\User as UserException;
use Fnsc\Domain\ValueObjects\Email;
use Fnsc\Infra\Models\Eloquent\User as UserModel;
use Fnsc\Infra\Repositories\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function testShouldStoreNewUser(): void
    {
        // Set
        $user = UserEntity::getNewUser(
            'Quentin Franecki',
            'https://via.placeholder.com/640x480.png/008811?text=nihil',
            'Port Theo',
            "Who Stole the Tarts? The King laid his hand upon her knee, and looking anxiously round to see a little bird as soon as look at me like that!' 'I couldn't afford to learn it.' said the King, going up.",
            'joshuah.lakin@example.org',
            '62c1eb78f0dc65e8d4063cc0'
        );

        $repository = new User();

        // Actions
        $result = $repository->store($user);

        // Assertions
        $this->assertInstanceOf(UserEntity::class, $result);
        $this->assertSame(
            '62c1eb78f0dc65e8d4063cc0',
            (string) $result->getId()
        );
        $this->assertSame('Quentin Franecki', $result->getName());
        $this->assertSame(
            'https://via.placeholder.com/640x480.png/008811?text=nihil',
            (string) $result->getAvatarUrl()
        );
        $this->assertSame('Port Theo', $result->getLocation());
        $this->assertSame(
            'joshuah.lakin@example.org',
            (string) $result->getEmail()
        );
    }

    public function testShouldUpdateUserThatAlreadyExists(): void
    {
        // Set
        UserModel::factory()->create([
            'id' => '62c1eb78f0dc65e8d4063cc0',
            'name' => 'Kian Zemlak',
            'email' => 'jadon.toy@example.com',
            'email_verified_at' => '2022-07-04 00:37:37',
            'avatar_url' => 'https://via.placeholder.com/640x480.png/004455?text=vel',
            'location' => 'Nadiatown',
            'bio' => 'Lorem Ipsum',
        ]);

        $user = UserEntity::getNewUser(
            'Quentin Franecki',
            'https://via.placeholder.com/640x480.png/008811?text=nihil',
            'Port Theo',
            "Who Stole the Tarts? The King laid his hand upon her knee, and looking anxiously round to see a little bird as soon as look at me like that!' 'I couldn't afford to learn it.' said the King, going up.",
            'joshuah.lakin@example.org',
            '62c1eb78f0dc65e8d4063cc0'
        );

        $repository = new User();

        // Actions
        $result = $repository->store($user);

        // Assertions
        $this->assertInstanceOf(UserEntity::class, $result);
        $this->assertSame(
            '62c1eb78f0dc65e8d4063cc0',
            (string) $result->getId()
        );
        $this->assertSame('Quentin Franecki', $result->getName());
        $this->assertSame(
            'https://via.placeholder.com/640x480.png/008811?text=nihil',
            (string) $result->getAvatarUrl()
        );
        $this->assertSame('Port Theo', $result->getLocation());
        $this->assertSame(
            'joshuah.lakin@example.org',
            (string) $result->getEmail()
        );
    }

    public function testShouldFindUserByEmail(): void
    {
        // Set
        UserModel::factory()->create([
            'id' => '62c1eb78f0dc65e8d4063cc0',
            'name' => 'Kian Zemlak',
            'email' => 'jadon.toy@example.com',
            'email_verified_at' => '2022-07-04 00:37:37',
            'avatar_url' => 'https://via.placeholder.com/640x480.png/004455?text=vel',
            'location' => 'Nadiatown',
            'bio' => 'Lorem Ipsum',
        ]);
        $email = new Email('jadon.toy@example.com');

        $repository = new User();

        // Actions
        $result = $repository->findByEmail($email);

        // Assertions
        $this->assertSame(
            'jadon.toy@example.com',
            (string) $result->getEmail()
        );
        $this->assertSame(
            '62c1eb78f0dc65e8d4063cc0',
            (string) $result->getId()
        );
    }

    public function testShouldThrowAnExceptionWhenUserNotFound(): void
    {
        // Set
        $email = new Email('jadon.toy@example.com');
        $repository = new User();

        // Expectations
        $this->expectException(UserException::class);
        $this->expectExceptionMessage('User not found.');

        // Actions
        $repository->findByEmail($email);
    }
}
