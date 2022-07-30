<?php

namespace Fnsc\Domain\ValueObjects;

class Company
{
    public function __construct(
        private readonly string $name,
        private readonly string $industry,
        private readonly Url $url,
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getIndustry(): string
    {
        return $this->industry;
    }

    /**
     * @return Url
     */
    public function getUrl(): Url
    {
        return $this->url;
    }
}
