<?php

namespace Fnsc\Application\GitHub;

use Fnsc\Application\Contracts\Config;
use Fnsc\Domain\Contracts\SocialMediaRepository;
use Fnsc\Domain\Contracts\UserRepository;
use Fnsc\Domain\Entities\SocialMedia;
use Fnsc\Domain\ValueObjects\Email;

class Service
{
    public function __construct(
        private readonly SocialMediaRepository $socialMediaRepository,
        private readonly UserRepository $userRepository,
        private readonly Config $config
    ) {
    }

    public function handle(InputBoundary $input): OutputBoundary
    {
        $email = new Email($input->getEmail());
        $user = $this->userRepository->findByEmail($email);
        $socialMedia = $this->getSocialMedia($input);

        $result = $this->socialMediaRepository->store($socialMedia, $user);

        return new OutputBoundary($result);
    }

    private function getSocialMedia(InputBoundary $input): SocialMedia
    {
        return SocialMedia::getNewSocialMedia(
            $this->config->get('user.social_media.github.name'),
            $input->getLogin(),
            $input->getProfileUrl(),
            $this->config->get('user.social_media.github.icon_path')
        );
    }
}
