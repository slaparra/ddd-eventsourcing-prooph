<?php

namespace Test\SharedKernel\Common;

use SharedKernel\Common\Assertion\AssertionFailedException;
use SharedKernel\Common\Uuid;
use PHPUnit\Framework\TestCase;

class UuidTest extends TestCase
{
    const UUID_STRING = '7322832c-f53b-4415-87fe-804cfbd0ab2f';

    public function testValidUuid()
    {
        $uuid = Uuid::fromString(self::UUID_STRING);

        $this->assertInstanceOf(Uuid::class, $uuid);
        $this->assertEquals(self::UUID_STRING, $uuid->toString());
    }

    public function testInvalidUuidShouldThrowAssertionFailedException()
    {
        $this->expectException(AssertionFailedException::class);

        Uuid::fromString('invalid uuid');
    }
}
