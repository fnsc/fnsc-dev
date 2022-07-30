<?php

namespace Fnsc\Application\Experience\Store;

use PHPUnit\Framework\TestCase;

class InputBoundaryTest extends TestCase
{
    public function testShouldGetInputInstance(): void
    {
        // Actions
        $result = new InputBoundary(
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
        $this->assertSame('Amazon', $result->getCompanyName());
        $this->assertSame('retail', $result->getCompanyIndustry());
        $this->assertSame('https://amazon.ca', $result->getCompanyUrl());
        $this->assertSame('2022-08-05', $result->getStartDate());
        $this->assertEmpty($result->getEndDate());
    }
}
