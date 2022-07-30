<?php

namespace Fnsc\Application\Experience\Store;

use Fnsc\Application\Contracts\Config;
use Fnsc\Domain\Contracts\ExperienceRepository;
use Fnsc\Domain\Contracts\UserRepository;
use Fnsc\Domain\Entities\Experience;
use Fnsc\Domain\Entities\User;
use Fnsc\Domain\ValueObjects\Email;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function testShouldHandle(): void
    {
        // Set
        $experienceRepository = $this->createMock(ExperienceRepository::class);
        $userRepository = $this->createMock(UserRepository::class);
        $config = m::mock(Config::class);
        $service = m::mock(
            Service::class . '[getExperienceEntity]',
            [$experienceRepository, $userRepository, $config]
        );
        $service->shouldAllowMockingProtectedMethods();

        $input = new InputBoundary(
            title: 'Software Engineer',
            employmentType: 'fulltime',
            location: 'Vancouver, BC, Canada',
            description: 'Lorem ipsum',
            companyName: 'Amazon',
            companyIndustry: 'retail',
            companyUrl: 'https://amazon.ca',
            startDate: '2022-08-05',
        );
        $authorizedEmail = 'johnDoe@gmail.com';
        $user = User::getNewUser(
            'John Doe',
            'https://avatar.github.com/johnDoe',
            'Vancouver, BC - Canada',
            'Lorem Ipsum',
            'johnDoe@github.com',
            '62c099719d621989ba0a8ff0'
        );
        $experience = Experience::getNewExperience(
            $input->getTitle(),
            $input->getEmploymentType(),
            $input->getLocation(),
            $input->getDescription(),
            $input->getCompanyName(),
            $input->getCompanyIndustry(),
            $input->getCompanyUrl(),
            $input->getStartDate(),
            $input->getEndDate(),
            '62e2c4b97691f5d4b90b4370'
        );

        // Expectations
        /** @phpstan-ignore-next-line */
        $service->expects()
            ->getExperienceEntity($input)
            ->andReturn($experience);

        /** @phpstan-ignore-next-line */
        $config->expects()
            ->get('user.authorized_user')
            ->andReturn($authorizedEmail);

        $userRepository->expects($this->once())
            ->method('findByEmail')
            ->with(new Email($authorizedEmail))
            ->willReturn($user);

        $experienceRepository->expects($this->once())
            ->method('store')
            ->with($experience, $user)
            ->willReturn($experience);

        // Actions
        /** @phpstan-ignore-next-line */
        $result = $service->handle($input);

        // Assertions
        $this->assertInstanceOf(OutputBoundary::class, $result);
    }
}
