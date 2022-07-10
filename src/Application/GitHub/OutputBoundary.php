<?php

namespace Fnsc\Application\GitHub;

use Fnsc\Domain\Entities\SocialMedia;

class OutputBoundary
{
    public function __construct(private readonly SocialMedia $socialMedia)
    {
    }

    /**
     * @return SocialMedia
     */
    public function getSocialMedia(): SocialMedia
    {
        return $this->socialMedia;
    }
}
