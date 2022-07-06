<?php

namespace Fnsc\Application\Home;

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

    public function handle(): OutputBoundary
    {
        $email = new Email($this->config->get('user.authorized_user'));
        $user = $this->userRepository->findByEmail($email);

        $socialMedia = $this->socialMediaRepository->getUserSocialMedia($user);

        return new OutputBoundary(
            $user,
            array_merge($socialMedia, $this->getAdditionalSocialMedia()),
            $this->getViewVars()
        );
    }

    /**
     * This will be removed when all integration services are done
     *
     * @return SocialMedia[]
     */
    private function getAdditionalSocialMedia(): array
    {
        $socialMedia = [];

        foreach ($this->config->get('user.social_media') as $socialNetwork) {
            if ('GitHub' === $socialNetwork['name']) {
                continue;
            }

            $socialMedia[] = SocialMedia::getNewSocialMedia(
                $socialNetwork['name'],
                $this->config->get('user.authorized_user'),
                $socialNetwork['profile_url'],
                $socialNetwork['icon_path'],
            );
        }

        return $socialMedia;
    }

    /**
     * @return array<string, string>
     */
    private function getViewVars(): array
    {
        return [
            'location' => 'Home',
            'title' => $this->config->get('view.variables.home.title'),
            'themeColor' => $this->config->get(
                'view.variables.home.themeColor'
            ),
            'description' => $this->config->get(
                'view.variables.home.description'
            ),
            'author' => $this->config->get('view.variables.home.author'),
            'keywords' => $this->config->get('view.variables.home.keywords'),
        ];
    }
}
