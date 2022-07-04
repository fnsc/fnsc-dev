<?php

namespace Fnsc\Presenters\Transformers;

use Fnsc\Domain\Entities\SocialMedia as SocialMediaEntity;

class SocialMedia
{
    /**
     * @param SocialMediaEntity $socialMedia
     * @return array<string, string>
     */
    public function transform(SocialMediaEntity $socialMedia): array
    {
        return [
            'name' => $socialMedia->getName(),
            'iconPath' => asset(
                $socialMedia->getIconPath()
            ) . '#' . strtolower(
                $socialMedia->getName()
            ),
            'profileUrl' => (string) $socialMedia->getProfileUrl(),
        ];
    }
}
