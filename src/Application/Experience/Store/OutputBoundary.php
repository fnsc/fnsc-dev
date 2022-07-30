<?php

namespace Fnsc\Application\Experience\Store;

use Fnsc\Domain\Entities\Experience;

class OutputBoundary
{
    public function __construct(private readonly Experience $experience)
    {
    }

    /**
     * @return Experience
     */
    public function getExperience(): Experience
    {
        return $this->experience;
    }
}
