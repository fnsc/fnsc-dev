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
            'id' => (string) $socialMedia->getId(),
            'name' => $socialMedia->getName(),
            'iconPath' => $this->getIconPath($socialMedia),
            'profileUrl' => (string) $socialMedia->getProfileUrl(),
        ];
    }

    /**
     * @param SocialMediaEntity $socialMedia
     * @return string
     */
    private function getIconPath(SocialMediaEntity $socialMedia): string
    {
        $name = str_replace(' ', '_', strtolower($socialMedia->getName()));

        if ('local' === config('app.env')) {
            return asset($socialMedia->getIconPath()) . '#' . $name;
        }

        return secure_asset($socialMedia->getIconPath()) . '#' . $name;
    }
}
