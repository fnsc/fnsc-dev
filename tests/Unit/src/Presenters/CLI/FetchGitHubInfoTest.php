<?php

namespace Fnsc\Presenters\CLI;

use Exception;
use Fnsc\Application\GitHub\InputBoundary;
use Fnsc\Application\GitHub\OutputBoundary;
use Fnsc\Application\GitHub\Service;
use Fnsc\Domain\Exceptions\User as UserException;
use Fnsc\Infra\Client\GitHub as GitHubClient;
use GuzzleHttp\Exception\ClientException;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FetchGitHubInfoTest extends TestCase
{
    public function testShouldHandle(): void
    {
        // Set
        $service = $this->createMock(Service::class);
        $gitHubClient = m::mock(GitHubClient::class);
        $logger = m::mock(LoggerInterface::class);
        /** @phpstan-ignore-next-line  */
        $command = new FetchGitHubInfo($service, $gitHubClient, $logger);

        $response = m::mock(ResponseInterface::class);
        $streamedResponse = m::mock(StreamedResponse::class);
        $input = new InputBoundary(
            'johnDoe',
            'https://github.com/johnDoe',
            'johnDoe@github.com'
        );

        // Expectations
        /** @phpstan-ignore-next-line  */
        $gitHubClient->expects()
            ->get()
            ->andReturn($response);

        /** @phpstan-ignore-next-line  */
        $response->expects()
            ->getBody()
            ->andReturn($streamedResponse);

        /** @phpstan-ignore-next-line  */
        $streamedResponse->expects()
            ->getContents()
            ->andReturn(
                '{"login":"johnDoe","html_url":"https://github.com/johnDoe","email":"johnDoe@github.com"}'
            );

        $service->expects($this->once())
            ->method('handle')
            ->with($input)
            ->willReturn(m::mock(OutputBoundary::class));

        // Actions
        $result = $command->handle();

        // Assertions
        $this->assertSame(0, $result);
    }

    public function testShouldThrowAnExceptionWhenGitHubApiFails(): void
    {
        // Set
        $service = $this->createMock(Service::class);
        $gitHubClient = m::mock(GitHubClient::class);
        $logger = m::mock(LoggerInterface::class);
        $command = new FetchGitHubInfo(
            $service,
            /** @phpstan-ignore-next-line  */
            $gitHubClient,
            /** @phpstan-ignore-next-line  */
            $logger
        );

        $exception = m::mock(ClientException::class);

        // Expectations
        /** @phpstan-ignore-next-line  */
        $gitHubClient->expects()
            ->get()
            ->andThrow($exception);

        /** @phpstan-ignore-next-line  */
        $logger->expects()
            ->notice(
                'Something went wrong while receiving info from GitHub.',
                ['exception' => $exception]
            );

        // Actions
        $result = $command->handle();

        // Assertions
        $this->assertEquals(1, $result);
    }

    public function testShouldThrowAnExceptionWhenSomethingUnexpectedHappen(): void
    {
        // Set
        $service = $this->createMock(Service::class);
        $gitHubClient = m::mock(GitHubClient::class);
        $logger = m::mock(LoggerInterface::class);
        $command = new FetchGitHubInfo(
            $service,
            /** @phpstan-ignore-next-line  */
            $gitHubClient,
            /** @phpstan-ignore-next-line  */
            $logger
        );

        $exception = m::mock(Exception::class);

        // Expectations
        /** @phpstan-ignore-next-line  */
        $gitHubClient->expects()
            ->get()
            ->andThrow($exception);

        /** @phpstan-ignore-next-line  */
        $logger->expects()
            ->notice(
                'Something unexpected has happened.',
                ['exception' => $exception]
            );

        // Actions
        $result = $command->handle();

        // Assertions
        $this->assertEquals(1, $result);
    }

    public function testShouldThrowAnExceptionWhenUserIssueHappen(): void
    {
        // Set
        $service = $this->createMock(Service::class);
        $gitHubClient = m::mock(GitHubClient::class);
        $logger = m::mock(LoggerInterface::class);
        $command = new FetchGitHubInfo(
            $service,
            /** @phpstan-ignore-next-line  */
            $gitHubClient,
            /** @phpstan-ignore-next-line  */
            $logger
        );

        $exception = UserException::notFound();

        // Expectations
        /** @phpstan-ignore-next-line  */
        $gitHubClient->expects()
            ->get()
            ->andThrow($exception);

        /** @phpstan-ignore-next-line  */
        $logger->expects()
            ->notice(
                'Something about the user is not working well.',
                ['exception' => $exception]
            );

        // Actions
        $result = $command->handle();

        // Assertions
        $this->assertEquals(1, $result);
    }
}
