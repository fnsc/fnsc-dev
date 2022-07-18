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
            $this->info('Adding new user from GitHub...');
            $response = $this->client->get();
            $gitHubUser = json_decode(
                $response->getBody()->getContents(),
                false
            );
            $input = InputBoundary::getInput($gitHubUser);
            $this->service->handle($input);
            $this->info('New user created.');

            return self::SUCCESS;
        } catch (ClientException $exception) {
            $this->logger->notice(
                'Something went wrong while receiving info from GitHub.',
                compact('exception')
            );

            $this->error(
                'Something went wrong while receiving info from GitHub. ' . $exception->getMessage()
            );

            return self::FAILURE;
        } catch (Exception $exception) {
            $this->logger->notice(
                'Something unexpected has happened.',
                compact('exception')
            );

            $this->error(
                'Something unexpected has happened. ' . $exception->getMessage()
            );

            return self::FAILURE;
        }
    }
}
