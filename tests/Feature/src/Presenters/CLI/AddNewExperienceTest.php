<?php

namespace Tests\Feature\Fnsc\Presenters\CLI;

use Exception;
use Fnsc\Application\Experience\Store\InputBoundary;
use Fnsc\Application\Experience\Store\OutputBoundary;
use Fnsc\Application\Experience\Store\Service;
use Mockery as m;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class AddNewExperienceTest extends TestCase
{
    public function testShouldCreateNewExperience(): void
    {
        // Set
        $service = $this->instance(Service::class, m::mock(Service::class));

        // Expectations
        /* @phpstan-ignore-next-line */
        $service->expects()
            ->handle(m::type(InputBoundary::class))
            ->andReturn(m::mock(OutputBoundary::class));

        // Actions
        /* @phpstan-ignore-next-line */
        $result = $this->artisan('experience:add')
            ->expectsQuestion('Position title', 'Software Enginner')
            ->expectsQuestion('Employment type', 'full time')
            ->expectsQuestion('Location', 'Vancouver, BC, Canada')
            ->expectsQuestion('Description', 'Lorem ipsum')
            ->expectsQuestion('Company Name', 'Amazon')
            ->expectsQuestion('Industry', 'retail')
            ->expectsQuestion('URL', 'https://amazon.ca')
            ->expectsQuestion('Start Date', '2022-09')
            ->expectsQuestion('End Date', '')
            ->expectsOutput('Adding new xp...')
            ->expectsOutput('New XP added.');

        // Assertions
        $result->assertExitCode(0);
    }

    public function testShouldThrowAnException(): void
    {
        // Set
        $service = $this->instance(Service::class, m::mock(Service::class));
        $logger = $this->instance(
            LoggerInterface::class,
            m::mock(LoggerInterface::class)
        );
        $exception = new Exception('unexpected error');

        // Expectations
        /* @phpstan-ignore-next-line */
        $service->expects()
            ->handle(m::type(InputBoundary::class))
            ->andThrow($exception);

        /* @phpstan-ignore-next-line */
        $logger->expects()
            ->error('Something went wrong.', ['exception' => $exception]);

        // Actions
        /* @phpstan-ignore-next-line */
        $result = $this->artisan('experience:add')
            ->expectsQuestion('Position title', 'Software Enginner')
            ->expectsQuestion('Employment type', 'full time')
            ->expectsQuestion('Location', 'Vancouver, BC, Canada')
            ->expectsQuestion('Description', 'Lorem ipsum')
            ->expectsQuestion('Company Name', 'Amazon')
            ->expectsQuestion('Industry', 'retail')
            ->expectsQuestion('URL', 'https://amazon.ca')
            ->expectsQuestion('Start Date', '2022-09')
            ->expectsQuestion('End Date', '')
            ->expectsOutput('Adding new xp...')
            ->expectsOutput('Something went wrong. unexpected error');

        // Assertions
        $result->assertExitCode(1);
    }
}
