<?php

namespace Fnsc\Presenters\CLI;

use Exception;
use Fnsc\Application\Experience\Store\InputBoundary;
use Fnsc\Application\Experience\Store\Service;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;

class AddNewExperience extends Command
{
    /**
     * The name and signature of the console command.
     *
     */
    protected $signature = 'experience:add
                            {--title=}
                            {--employmentType=}
                            {--location=}
                            {--description=}
                            {--companyName=}
                            {--companyIndustry=}
                            {--companyUrl=}
                            {--startDate=}
                            {--endDate=}';

    /**
     * The console command description.
     *
     */
    protected $description = 'Add new experience to database';

    public function __construct(
        private readonly Service $service,
        private readonly LoggerInterface $logger,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        try {
            $input = $this->getInput();
            $this->info('Adding new xp...');
            $this->service->handle($input);

            $this->info('New XP added.');

            return self::SUCCESS;
        } catch (Exception $exception) {
            $this->logger->error(
                'Something went wrong.',
                compact('exception')
            );
            $this->error('Something went wrong. ' . $exception->getMessage());

            return self::FAILURE;
        }
    }

    private function getInput(): InputBoundary
    {
        $title = $this->ask('Position title');
        $employmentType = $this->ask('Employment type');
        $location = $this->ask('Location');
        $description = $this->ask('Description');
        $companyName = $this->ask('Company Name');
        $industry = $this->ask('Industry');
        $url = $this->ask('URL');
        $startDate = $this->ask('Start Date');
        $endDate = $this->ask('End Date');

        return new InputBoundary(
            $title,
            $employmentType,
            $location,
            $description,
            $companyName,
            $industry,
            $url,
            $startDate,
            $endDate ?? '',
        );
    }
}
