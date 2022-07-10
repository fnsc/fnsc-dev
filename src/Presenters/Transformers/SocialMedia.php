<?php

namespace Fnsc\Presenters\Transformers;

use Fnsc\Application\Contracts\UrlGenerator;
use Fnsc\Domain\Entities\SocialMedia as SocialMediaEntity;

class SocialMedia
{
    public function __construct(private readonly UrlGenerator $urlGenerator)
    {
    }

    /**
     * @param SocialMediaEntity $socialMedia
     * @return array<string, string>
     */
    public function transform(SocialMediaEntity $socialMedia): array
    {
        return [
            'id' => (string) $socialMedia->getId(),
            'name' => $socialMedia->getName(),
            'iconPath' => $this->urlGenerator->asset(
                $socialMedia->getIconPath()
            ),
            'profileUrl' => (string) $socialMedia->getProfileUrl(),
        ];
    }
}
