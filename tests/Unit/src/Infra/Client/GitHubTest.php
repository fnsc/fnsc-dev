<?php

namespace Fnsc\Infra\Client;

use Fnsc\Infra\Adapters\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class GitHubTest extends TestCase
{
    public function testShouldGetGitHubInfo(): void
    {
        // Set
        $guzzleHttp = $this->createMock(Client::class);
        $config = m::mock(Config::class);
        /** @phpstan-ignore-next-line */
        $client = new GitHub($guzzleHttp, $config);

        $uri = 'https://api.github.com/johnDoe';

        // Expectations
        /** @phpstan-ignore-next-line */
        $config->expects()
            ->get('user.social_media.github.api.url')
            ->andReturn($uri);

        /** @phpstan-ignore-next-line */
        $config->expects()
            ->get('user.social_media.github.api.token')
            ->andReturn('api_token');

        $guzzleHttp->expects($this->once())
            ->method('get')
            ->with($uri, [
                'headers' => [
                    'Authorization' => 'Bearer api_token',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
            ])
            ->willReturn(m::mock(ResponseInterface::class));

        // Actions
        $result = $client->get();

        // Assertions
        $this->assertInstanceOf(ResponseInterface::class, $result);
    }

    public function testShouldThrowAnExceptionWhenRequestFails(): void
    {
        // Set
        $guzzleHttp = $this->createMock(Client::class);
        $config = m::mock(Config::class);
        /** @phpstan-ignore-next-line */
        $client = new GitHub($guzzleHttp, $config);

        $uri = 'https://api.github.com/johnDoe';

        // Expectations
        /** @phpstan-ignore-next-line */
        $config->expects()
            ->get('user.social_media.github.api.url')
            ->andReturn($uri);

        /** @phpstan-ignore-next-line */
        $config->expects()
            ->get('user.social_media.github.api.token')
            ->andReturn('api_token');

        $guzzleHttp->expects($this->once())
            ->method('get')
            ->with($uri, [
                'headers' => [
                    'Authorization' => 'Bearer api_token',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
            ])
            /** @phpstan-ignore-next-line  */
            ->willThrowException(m::mock(ClientException::class));

        $this->expectException(GuzzleException::class);

        // Actions
        $client->get();
    }
}
