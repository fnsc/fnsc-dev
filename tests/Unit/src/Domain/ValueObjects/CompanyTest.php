<?php

namespace Fnsc\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    public function testShouldGetCompanyInstance(): void
    {
        // Actions
        $result = new Company(
            name: 'Amazon',
            industry: 'retail',
            url: new Url('https://amazon.ca')
        );

        // Assertions
        $this->assertSame('Amazon', $result->getName());
        $this->assertSame('retail', $result->getIndustry());
        $this->assertInstanceOf(Url::class, $result->getUrl());
    }
}
