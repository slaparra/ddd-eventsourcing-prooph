<?php

namespace Test\SharedKernel\Domain\Event;

use SharedKernel\Common\Uuid;
use SharedKernel\Domain\Event\DomainEvent;

class FakeDomainEvent extends DomainEvent
{
    public static function build()
    {
        return DomainEvent::fromPayload(Uuid::fromString('5ddb0240-8200-4d10-abb1-4d01b278ddf4'), []);
    }
}
