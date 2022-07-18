<?php

namespace Fnsc\Infra\Repositories;

use DateTimeImmutable;
use DomainException;
use Fnsc\Domain\Contracts\ExperienceRepository;
use Fnsc\Domain\Entities\Experience as ExperienceEntity;
use Fnsc\Domain\Entities\User as UserEntity;
use Fnsc\Domain\ValueObjects\Company;
use Fnsc\Infra\Models\Eloquent\Experience as ExperienceModel;
use MongoDB\BSON\ObjectId;

class Experience implements ExperienceRepository
{
    public function store(ExperienceEntity $experience, UserEntity $user): ExperienceEntity
    {
        $experienceModel = $this->firstOrCreate(
            $experience->getStartDate(),
            $experience->getCompany()
        );

        if (!empty($experienceModel->getAttribute('id'))) {
            $this->setAttributes($experienceModel, $experience, $user);
            $experienceModel->save();

            return $this->getExperienceEntity(
                $this->first($experienceModel->getAttribute('id'))
            );
        }

        $this->setAttributes($experienceModel, $experience, $user);
        $experienceModel->setAttribute('id', $experience->getId());
        $experienceModel->save();

        return $this->getExperienceEntity(
            $this->first($experience->getId())
        );
    }

    /**
     * @param Company $company
     * @return string
     */
    public function transformCompany(Company $company): string
    {
        $encodedCompany = json_encode([
            'name' => $company->getName(),
            'industry' => $company->getIndustry(),
            'url' => (string) $company->getUrl(),
        ]);

        return $encodedCompany ?: '';
    }

    private function firstOrCreate(DateTimeImmutable $startDate, Company $company): ExperienceModel
    {
        /** @phpstan-ignore-next-line */
        $experience = ExperienceModel::where('start_date', $startDate)
            ->whereJsonContains('company', ['name' => $company->getName()])
            ->first();

        if ($experience) {
            return $experience;
        }

        return new ExperienceModel();
    }

    private function setAttributes(
        ExperienceModel $experienceModel,
        ExperienceEntity $experienceEntity,
        UserEntity $userEntity
    ): void {
        $experienceModel->setAttribute('user_id', $userEntity->getId());
        $experienceModel->setAttribute('title', $experienceEntity->getTitle());
        $experienceModel->setAttribute(
            'employment_type',
            $experienceEntity->getEmploymentType()
        );
        $experienceModel->setAttribute(
            'location',
            $experienceEntity->getLocation()
        );
        $experienceModel->setAttribute(
            'description',
            $experienceEntity->getDescription()
        );
        $experienceModel->setAttribute(
            'company',
            $this->transformCompany($experienceEntity->getCompany())
        );
        $experienceModel->setAttribute(
            'start_date',
            $experienceEntity->getStartDate()
        );
        $experienceModel->setAttribute(
            'end_date',
            $experienceEntity->getEndDate()
        );
    }

    private function first(ObjectId $id): ExperienceModel
    {
        /* @phpstan-ignore-next-line */
        if (!$experience = ExperienceModel::where('id', $id)->first()) {
            throw new DomainException('not found');
        }

        return $experience;
    }

    private function getExperienceEntity(ExperienceModel $experienceModel): ExperienceEntity
    {
        $company = $experienceModel->getAttribute('company');

        return ExperienceEntity::getNewExperience(
            $experienceModel->getAttribute('title'),
            $experienceModel->getAttribute('employment_type'),
            $experienceModel->getAttribute('location'),
            $experienceModel->getAttribute('description'),
            $company->getName(),
            $company->getIndustry(),
            $company->getUrl(),
            $experienceModel->getAttribute('start_date'),
            $experienceModel->getAttribute('end_date') ?? '',
            $experienceModel->getAttribute('id'),
        );
    }
}
