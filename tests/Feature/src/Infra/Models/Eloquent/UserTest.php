<?php

namespace Tests\Feature\Fnsc\Infra\Models\Eloquent;

use Fnsc\Infra\Models\Eloquent\SocialMedia;
use Fnsc\Infra\Models\Eloquent\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function testShouldGetUserThatIsTheSocialMediaOwner(): void
    {
        // Set
        /** @phpstan-ignore-next-line  */
        $user = User::factory()->create(['name' => 'John Doe'])->first();
        /** @phpstan-ignore-next-line  */
        SocialMedia::factory()->create([
            /** @phpstan-ignore-next-line  */
            'user_id' => (string) $user->getAttribute('id'),
            'name' => 'GitHub',
        ])->first();

        // Actions
        /** @phpstan-ignore-next-line  */
        $result = $user->socialMedia;

        // Assertions
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertSame('GitHub', $result->first()->getAttribute('name'));
    }
}
