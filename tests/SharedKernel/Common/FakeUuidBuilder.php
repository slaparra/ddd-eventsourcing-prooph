<?php

namespace Test\SharedKernel\Common;

use SharedKernel\Common\Uuid;

class FakeUuidBuilder
{
    const FAKE_UUID = '92922bf0-b74c-41de-a21d-28a9ce8ffdfa';

    public static function build(): Uuid
    {
        return Uuid::fromString(self::FAKE_UUID);
    }
}
