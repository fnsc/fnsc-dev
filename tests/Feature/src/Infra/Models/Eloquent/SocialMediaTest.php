<?php

namespace Tests\Feature\Fnsc\Infra\Models\Eloquent;

use Fnsc\Infra\Models\Eloquent\SocialMedia;
use Fnsc\Infra\Models\Eloquent\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SocialMediaTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function testShouldGetUserThatIsTheSocialMediaOwner(): void
    {
        // Set
        /** @phpstan-ignore-next-line  */
        $user = User::factory()->create(['name' => 'John Doe'])->first();
        /** @phpstan-ignore-next-line  */
        $socialMedia = SocialMedia::factory()->create([
            /** @phpstan-ignore-next-line  */
            'user_id' => (string) $user->getAttribute('id'),
        ])->first();

        // Actions
        /** @phpstan-ignore-next-line  */
        $result = $socialMedia->user;

        // Assertions
        $this->assertInstanceOf(User::class, $result);
        $this->assertSame('John Doe', $result->getAttribute('name'));
    }
}
