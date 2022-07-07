<?php

namespace Fnsc\Application\Home;

use Fnsc\Domain\Entities\SocialMedia;
use Fnsc\Domain\Entities\User;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class OutputBoundaryTest extends TestCase
{
    public function testShouldGetOutputBoundaryInstance(): void
    {
        $user = m::mock(User::class);
        $socialMedia = [m::mock(SocialMedia::class)];
        $baseViewVars = ['author' => 'John Doe'];

        // Actions
        /** @phpstan-ignore-next-line */
        $result = new OutputBoundary($user, $socialMedia, $baseViewVars);

        // Assertions
        $this->assertInstanceOf(User::class, $result->getUser());
        $this->assertInstanceOf(
            SocialMedia::class,
            current($result->getSocialMedia())
        );
        $this->assertSame(
            ['author' => 'John Doe'],
            $result->getBaseViewVars()
        );
    }
}
