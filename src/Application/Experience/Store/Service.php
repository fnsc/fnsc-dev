<?php

namespace Fnsc\Application\Experience\Store;

use Fnsc\Application\Contracts\Config;
use Fnsc\Domain\Contracts\ExperienceRepository;
use Fnsc\Domain\Contracts\UserRepository;
use Fnsc\Domain\Entities\Experience;
use Fnsc\Domain\ValueObjects\Email;

class Service
{
    public function __construct(
        private readonly ExperienceRepository $experienceRepository,
        private readonly UserRepository $userRepository,
        private readonly Config $config
    ) {
    }

    public function handle(InputBoundary $input): OutputBoundary
    {
        $experience = $this->getExperienceEntity($input);

        $email = new Email($this->config->get('user.authorized_user'));
        $user = $this->userRepository->findByEmail($email);

        $result = $this->experienceRepository->store($experience, $user);

        return new OutputBoundary($result);
    }

    protected function getExperienceEntity(InputBoundary $input): Experience
    {
        return Experience::getNewExperience(
            $input->getTitle(),
            $input->getEmploymentType(),
            $input->getLocation(),
            $input->getDescription(),
            $input->getCompanyName(),
            $input->getCompanyIndustry(),
            $input->getCompanyUrl(),
            $input->getStartDate(),
            $input->getEndDate(),
        );
    }
}
