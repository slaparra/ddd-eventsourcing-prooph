<?php

namespace Test\SharedKernel\Application\Command;

use SharedKernel\Application\Command\NullCommandResult;
use PHPUnit\Framework\TestCase;

class NullCommandResultTest extends TestCase
{
    public function testNullCommandResultInstanceMethodShouldCreateTheInstanceProperly()
    {
        $this->assertInstanceOf(NullCommandResult::class, NullCommandResult::instance());
    }
}
