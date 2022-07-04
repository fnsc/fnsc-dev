<?php

namespace Fnsc\Application\Home;

use Fnsc\Application\Contracts\Config;
use Fnsc\Domain\Contracts\SocialMediaRepository;
use Fnsc\Domain\Contracts\UserRepository;
use Fnsc\Domain\ValueObjects\Email;

class Service
{
    public function __construct(
        private readonly SocialMediaRepository $socialMediaRepository,
        private readonly UserRepository $userRepository,
        private readonly Config $config
    ) {
    }

    public function handle(): OutputBoundary
    {
        $email = new Email($this->config->get('user.authorized_user'));
        $user = $this->userRepository->findByEmail($email);

        $socialMedia = $this->socialMediaRepository->getUserSocialMedia($user);

        return new OutputBoundary($user, $socialMedia);
    }
}
