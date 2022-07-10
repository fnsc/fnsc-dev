<?php

namespace Fnsc\Infra\Adapters;

use Illuminate\Config\Repository;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testShouldGetConfigValue(): void
    {
        // Set
        $repository = $this->createMock(Repository::class);
        $config = new Config($repository);

        // Expectations
        $repository->expects($this->once())
            ->method('get')
            ->with('user.authorized_user')
            ->willReturn('johnDoe@github.com');

        // Actions
        $result = $config->get('user.authorized_user');

        // Assertions
        $this->assertSame('johnDoe@github.com', $result);
    }
}
