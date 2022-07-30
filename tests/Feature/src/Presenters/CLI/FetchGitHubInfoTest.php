<?php

namespace Tests\Feature\Fnsc\Presenters\CLI;

use Exception;
use Fnsc\Application\GitHub\InputBoundary;
use Fnsc\Application\GitHub\Service;
use Fnsc\Domain\Exceptions\User as UserException;
use Fnsc\Infra\Client\GitHub as GitHubClient;
use Fnsc\Infra\Models\Eloquent\User;
use GuzzleHttp\Exception\ClientException;
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

    public function testShouldThrowAnExceptionWhenClientFails(): void
    {
        // Set
        $gitHubClient = $this->instance(
            GitHubClient::class,
            m::mock(GitHubClient::class)
        );

        // Expectations
        /* @phpstan-ignore-next-line */
        $gitHubClient->expects()
            ->get()
            ->andThrow(m::mock(ClientException::class));

        // Actions
        /** @phpstan-ignore-next-line */
        $result = $this->artisan('social:fetch-github')
            ->expectsOutput('Adding GitHub social media info...');

        // Assertions
        $result->assertFailed();
    }

    public function testShouldThrowAnExceptionWhenServiceFailsByUserError(): void
    {
        // Set
        $gitHubClient = $this->instance(
            GitHubClient::class,
            m::mock(GitHubClient::class)
        );
        $service = $this->instance(Service::class, m::mock(Service::class));
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

        /* @phpstan-ignore-next-line */
        $service->expects()
            ->handle(m::type(InputBoundary::class))
            ->andThrow(UserException::invalidEmail());

        // Actions
        /** @phpstan-ignore-next-line */
        $result = $this->artisan('social:fetch-github')
            ->expectsOutput('Adding GitHub social media info...')
            ->expectsOutput(
                'Something about the user is not working well. Invalid email provided.'
            );

        // Assertions
        $result->assertFailed();
    }

    public function testShouldThrowAnExceptionWhenServiceFailsByUnexpectedError(): void
    {
        // Set
        $gitHubClient = $this->instance(
            GitHubClient::class,
            m::mock(GitHubClient::class)
        );
        $service = $this->instance(Service::class, m::mock(Service::class));
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

        /* @phpstan-ignore-next-line */
        $service->expects()
            ->handle(m::type(InputBoundary::class))
            ->andThrow(new Exception('Unexpected error.'));

        // Actions
        /** @phpstan-ignore-next-line */
        $result = $this->artisan('social:fetch-github')
            ->expectsOutput('Adding GitHub social media info...')
            ->expectsOutput(
                'Something unexpected has happened. Unexpected error.'
            );

        // Assertions
        $result->assertFailed();
    }
}
