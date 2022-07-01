<?php

namespace Fnsc\Presenters\CLI;

use Exception;
use Fnsc\Application\User\Store\InputBoundary;
use Fnsc\Application\User\Store\Service;
use Fnsc\Infra\Client\GitHub as GitHubClient;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;

class CreateNewUserFromGitHubData extends Command
{
    /**
     * The name and signature of the console command.
     *
     */
    protected $signature = 'user:fetch-github';

    /**
     * The console command description.
     *
     */
    protected $description = 'Fetch the user information from the GitHub';

    public function __construct(
        private readonly Service $service,
        private readonly GitHubClient $client,
        private readonly LoggerInterface $logger
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        try {
            $response = $this->client->get();
            $gitHubUser = json_decode(
                $response->getBody()->getContents(),
                false
            );
            $input = InputBoundary::getInput($gitHubUser);
            $this->service->handle($input);

            return self::SUCCESS;
        } catch (ClientException $exception) {
            $this->logger->notice(
                'Something went wrong while receiving info from GitHub.',
                compact('exception')
            );

            return self::FAILURE;
        } catch (Exception $exception) {
            $this->logger->notice(
                'Something unexpected has happened.',
                compact('exception')
            );

            return self::FAILURE;
        }
    }
}
