<?php

namespace Tests\Feature\Fnsc\Presenters\CLI;

use Fnsc\Infra\Client\GitHub as GitHubClient;
use Fnsc\Infra\Models\Eloquent\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Tests\TestCase;

class FetchGitHubInfoTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testShouldStoreGitHubSocialMediaData(): void
    {
        // Set
        User::factory()->create([
            'email' => 'johnDoe@github.com',
        ]);

        $gitHubClient = $this->instance(
            GitHubClient::class,
            m::mock(GitHubClient::class)
        );
        $response = m::mock(ResponseInterface::class);
        $responseContent = m::mock(StreamInterface::class);

        // Expectations
        /* @phpstan-ignore-next-line */
        $gitHubClient->expects()
            ->get()
            ->andReturn($response);

        /* @phpstan-ignore-next-line */
        $response->expects()
            ->getBody()
            ->andReturn($responseContent);

        /* @phpstan-ignore-next-line */
        $responseContent->expects()
            ->getContents()
            ->andReturn(
                '{"login":"johnDoe","html_url":"https://github.com/johnDoe","email":"johnDoe@github.com"}'
            );

        // Actions
        $result = $this->artisan('social:fetch-github');

        // Assertions
        /* @phpstan-ignore-next-line */
        $result->assertSuccessful();
    }
}
