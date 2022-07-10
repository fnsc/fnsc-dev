<?php

namespace Fnsc\Presenters\Transformers\Home;

use Fnsc\Application\Home\OutputBoundary;
use Fnsc\Presenters\Transformers\SocialMedia as SocialMediaTransformer;
use Fnsc\Presenters\Transformers\User as UserTransformer;
use Fnsc\Presenters\Transformers\ViewVars as ViewVarsTransformer;

class Transformer
{
    public function __construct(
        private readonly SocialMediaTransformer $socialMediaTransformer,
        private readonly UserTransformer $userTransformer,
        private readonly ViewVarsTransformer $viewVarsTransformer
    ) {
    }

    /**
     * @param OutputBoundary $output
     * @return array<string, mixed>
     */
    public function transform(OutputBoundary $output): array
    {
        $user = $this->userTransformer->transform($output->getUser());
        $socialMedia = $this->getSocialMedia($output);
        $viewVars = $this->viewVarsTransformer->transform(
            $output->getBaseViewVars()
        );

        return array_merge($viewVars, compact('user', 'socialMedia'));
    }

    /**
     * @param OutputBoundary $result
     * @return array<int, array<string, string>>
     */
    private function getSocialMedia(OutputBoundary $result): array
    {
        $socialMedia = [];

        foreach ($result->getSocialMedia() as $socialNetwork) {
            $socialMedia[] = $this->socialMediaTransformer->transform(
                $socialNetwork
            );
        }

        return $socialMedia;
    }
}
