<?php

namespace Fnsc\Domain\Entities;

use DateTimeImmutable;
use MongoDB\BSON\ObjectId;
use PHPUnit\Framework\TestCase;

class ExperienceTest extends TestCase
{
    public function testShouldGetExperienceInstance(): void
    {
        // Actions
        $result = Experience::getNewExperience(
            title: 'Software Engineer',
            employmentType: 'fulltime',
            location: 'Vancouver, BC, Canada',
            description: 'Lorem ipsum',
            companyName: 'Amazon',
            companyIndustry: 'retail',
            companyUrl: 'https://amazon.ca',
            startDate: '2022-08-05',
        );

        // Assertions
        $this->assertSame('Software Engineer', $result->getTitle());
        $this->assertSame('fulltime', $result->getEmploymentType());
        $this->assertSame('Vancouver, BC, Canada', $result->getLocation());
        $this->assertSame('Lorem ipsum', $result->getDescription());
        $this->assertSame('Amazon', $result->getCompany()->getName());
        $this->assertSame('retail', $result->getCompany()->getIndustry());
        $this->assertSame(
            'https://amazon.ca',
            (string) $result->getCompany()->getUrl()
        );
        $this->assertNull($result->getEndDate());
        $this->assertInstanceOf(
            DateTimeImmutable::class,
            $result->getStartDate()
        );
        $this->assertInstanceOf(ObjectId::class, $result->getId());
    }
}
