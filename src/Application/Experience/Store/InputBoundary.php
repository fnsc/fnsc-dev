<?php

namespace Fnsc\Application\Experience\Store;

class InputBoundary
{
    public function __construct(
        private readonly string $title,
        private readonly string $employmentType,
        private readonly string $location,
        private readonly string $description,
        private readonly string $companyName,
        private readonly string $companyIndustry,
        private readonly string $companyUrl,
        private readonly string $startDate,
        private readonly string $endDate = '',
    ) {
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getEmploymentType(): string
    {
        return $this->employmentType;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @return string
     */
    public function getCompanyIndustry(): string
    {
        return $this->companyIndustry;
    }

    /**
     * @return string
     */
    public function getCompanyUrl(): string
    {
        return $this->companyUrl;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }
}
