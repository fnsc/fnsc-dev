<?php

namespace Tests\Feature\Fnsc\Presenters\CLI;

use Fnsc\Infra\Client\GitHub as GitHubClient;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Tests\TestCase;

class CreateNewUserFromGitHubDataTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function testShouldCreateNewUserFromGitHubData(): void
    {
        // Set
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
                '{"avatar_url":"https://avatars.githubusercontent.com/u/23709089?v=4","name":"Gabriel Fonseca","location":"São Paulo, São Paulo, Brazil","email":"gabrieldfnsc@gmail.com","bio":"A developer from Paracatu/MG living in São Paulo"}'
            );

        // Actions
        $result = $this->artisan('user:fetch-github');

        // Assertions
        /* @phpstan-ignore-next-line */
        $result->assertSuccessful();
    }
}
