<?php

namespace Fnsc\Presenters\Transformers;

use Fnsc\Application\Contracts\UrlGenerator;
use Fnsc\Domain\ValueObjects\ViewVars as ViewVarsValueObject;

class ViewVars
{
    public function __construct(private readonly UrlGenerator $urlGenerator)
    {
    }

    /**
     * @param ViewVarsValueObject $viewVars
     * @return array<string, array<string, array<string, string>>|string>
     */
    public function transform(ViewVarsValueObject $viewVars): array
    {
        return [
            'title' => $viewVars->getTitle(),
            'location' => $viewVars->getLocation(),
            'author' => $viewVars->getAuthor(),
            'description' => $viewVars->getDescription(),
            'icons' => $this->transformIcons($viewVars->getIcons()),
            'keywords' => $viewVars->getKeywords(),
            'themeColor' => $viewVars->getThemeColor(),
        ];
    }

    /**
     * @param array<string, array<string, string>> $viewVarsIcons
     * @return array<string, array<string, string>>
     */
    private function transformIcons(array $viewVarsIcons): array
    {
        $icons = [];

        foreach ($viewVarsIcons as $name => $properties) {
            $icons[$name] = [
                'name' => $name,
                'url' => $this->urlGenerator->asset($properties['path']),
            ];
        }

        return $icons;
    }
}
