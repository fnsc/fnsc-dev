<?php

namespace Fnsc\Infra\Client;

use Fnsc\Infra\Adapters\Config;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class GitHub
{
    public function __construct(
        private readonly Client $client,
        private readonly Config $config
    ) {
    }

    public function get(): ResponseInterface
    {
        $uri = $this->config->get('user.social_media.github.api.url');
        $options = $this->getOptions();

        return $this->client->get($uri, $options);
    }

    /**
     * @return array<string, array<string>>
     */
    protected function getOptions(): array
    {
        $options = [];
        $options['headers'] = $this->getHeaders();

        return $options;
    }

    /**
     * @return string[]
     */
    private function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->config->get(
                'user.social_media.github.api.token'
            ),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
