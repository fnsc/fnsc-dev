<?php

namespace Tests\Feature\Fnsc\Presenters\Http\Controllers\Front;

use Exception;
use Fnsc\Application\Home\Service;
use Fnsc\Domain\Exceptions\User as UserException;
use Fnsc\Infra\Models\Eloquent\SocialMedia;
use Fnsc\Infra\Models\Eloquent\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Mockery as m;
use MongoDB\BSON\ObjectId;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testShouldRenderHomePage(): void
    {
        // Set
        $this->getUser();
        $this->storeSocialMedia();

        // Actions
        $result = $this->get('/');

        // Assertions
        $result->assertStatus(Response::HTTP_OK);
        $result->assertViewHas('title', 'John Doe');
    }

    /**
     * @dataProvider getExceptionsScenarios
     */
    public function testShouldThrowAnException(Exception $exception, int $statusCode): void
    {
        // Set
        $service = $this->instance(Service::class, m::mock(Service::class));

        // Expectations
        /** @phpstan-ignore-next-line  */
        $service->expects()
            ->handle()
            ->andThrow($exception);

        // Actions
        $result = $this->get('/');

        // Assertions
        $result->assertStatus($statusCode);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function getExceptionsScenarios(): array
    {
        return [
            'throw user exception' => [
                'exception' => UserException::notFound(),
                'status' => Response::HTTP_FORBIDDEN,
            ],
            'throw unexpected error' => [
                'exception' => new Exception('Unexpected error'),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ],
        ];
    }

    private function getUser(): void
    {
        config(['user.authorized_user' => 'johnDoe@gmail.com']);

        /** @phpstan-ignore-next-line */
        User::factory()->create([
            'id' => (string) new ObjectId('62c1eb78f0dc65e8d4063cc0'),
            'email' => 'johnDoe@gmail.com',
            'name' => 'John Doe',
        ])->first();
    }

    private function storeSocialMedia(): void
    {
        SocialMedia::factory()->create([
            'name' => 'GitHub',
            'username' => 'johnDoe',
            'profile_url' => 'https://github.com/johnDoe',
            'icon_path' => 'img/social/github.svg',
            'id' => '62c1e86b564afba894002110',
        ]);
    }
}
