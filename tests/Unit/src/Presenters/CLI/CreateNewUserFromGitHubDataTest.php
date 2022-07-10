<?php

namespace Fnsc\Presenters\CLI;

use Exception;
use Fnsc\Application\User\Store\Service;
use Fnsc\Application\User\Store\InputBoundary;
use Fnsc\Application\User\Store\OutputBoundary;
use Fnsc\Infra\Client\GitHub as GitHubClient;
use GuzzleHttp\Exception\ClientException;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use stdClass;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CreateNewUserFromGitHubDataTest extends TestCase
{
    public function testShouldHandle(): void
    {
        // Set
        $service = $this->createMock(Service::class);
        $gitHubClient = m::mock(GitHubClient::class);
        $logger = m::mock(LoggerInterface::class);
        $command = new CreateNewUserFromGitHubData(
            $service,
            /** @phpstan-ignore-next-line  */
            $gitHubClient,
            /** @phpstan-ignore-next-line  */
            $logger
        );

        $response = m::mock(ResponseInterface::class);
        $streamedResponse = m::mock(StreamedResponse::class);
        $stdClass = new stdClass();
        $stdClass->name = 'John Doe';
        $stdClass->avatar_url = 'https://github.com/johnDoe';
        $stdClass->location = 'Vancouver, BC, Canada';
        $stdClass->bio = 'Lorem ipsum';
        $stdClass->email = 'johnDoe@github.com';
        $input = InputBoundary::getInput($stdClass);

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
                '{"name":"John Doe","avatar_url":"https://github.com/johnDoe","location":"Vancouver, BC, Canada","bio":"Lorem ipsum","email":"johnDoe@github.com"}'
            );

        $service->expects($this->once())
            ->method('handle')
            ->with($input)
            ->willReturn(m::mock(OutputBoundary::class));

        // Actions
        $result = $command->handle();

        // Assertions
        $this->assertEquals(0, $result);
    }

    public function testShouldThrowAnExceptionWhenGitHubApiFails(): void
    {
        // Set
        $service = $this->createMock(Service::class);
        $gitHubClient = m::mock(GitHubClient::class);
        $logger = m::mock(LoggerInterface::class);
        $command = new CreateNewUserFromGitHubData(
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
        $command = new CreateNewUserFromGitHubData(
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
}
