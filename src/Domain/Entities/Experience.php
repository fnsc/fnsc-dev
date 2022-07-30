<?php

namespace Fnsc\Domain\Entities;

use DateTimeImmutable;
use Fnsc\Domain\ObjectIdGenerator;
use Fnsc\Domain\ValueObjects\Company;
use Fnsc\Domain\ValueObjects\Url;
use MongoDB\BSON\ObjectId;

class Experience
{
    use ObjectIdGenerator;

    private function __construct(
        private readonly ObjectId $id,
        private readonly string $title,
        private readonly string $employmentType,
        private readonly string $location,
        private readonly string $description,
        private readonly Company $company,
        private readonly DateTimeImmutable $startDate,
        private readonly ?DateTimeImmutable $endDate,
    ) {
    }

    public static function getNewExperience(
        string $title,
        string $employmentType,
        string $location,
        string $description,
        string $companyName,
        string $companyIndustry,
        string $companyUrl,
        string $startDate,
        string $endDate = '',
        string $id = '',
    ): self {
        $companyUrl = new Url($companyUrl);
        $company = new Company($companyName, $companyIndustry, $companyUrl);

        $startDate = new DateTimeImmutable($startDate);
        $endDate = !empty($endDate) ? new DateTimeImmutable($endDate) : null;

        return new self(
            id: self::getObjectId($id),
            title: $title,
            employmentType: $employmentType,
            location: $location,
            description: $description,
            company: $company,
            startDate: $startDate,
            endDate: $endDate
        );
    }

    /**
     * @return ObjectId
     */
    public function getId(): ObjectId
    {
        return $this->id;
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
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
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
     * @return DateTimeImmutable
     */
    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getEndDate(): ?DateTimeImmutable
    {
        return $this->endDate;
    }
}
