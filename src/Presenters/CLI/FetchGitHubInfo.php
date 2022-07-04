<?php

namespace Fnsc\Presenters\CLI;

use Exception;
use Fnsc\Application\GitHub\Service;
use Fnsc\Application\GitHub\InputBoundary;
use Fnsc\Domain\Exceptions\User as UserException;
use Fnsc\Infra\Client\GitHub as GitHubClient;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;

class FetchGitHubInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     */
    protected $signature = 'social:fetch-github';

    /**
     * The console command description.
     *
     */
    protected $description = 'Fetch the social information from the GitHub';

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
            $gitHubData = json_decode(
                $response->getBody()->getContents(),
                false
            );
            $input = new InputBoundary(
                $gitHubData->login,
                $gitHubData->html_url,
                $gitHubData->email
            );
            $this->service->handle($input);

            return self::SUCCESS;
        } catch (ClientException $exception) {
            $this->logger->notice(
                'Something went wrong while receiving info from GitHub.',
                compact('exception')
            );

            return self::FAILURE;
        } catch (UserException $exception) {
            $this->logger->notice(
                'Something about the user is not working well.',
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
