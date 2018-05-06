<?php

namespace Test\SharedKernel\Domain\Event;

use SharedKernel\Common\Uuid;
use SharedKernel\Domain\Event\DomainEvent;

class FakeDomainEvent extends DomainEvent
{
    const FAKE_UUID = '5ddb0240-8200-4d10-abb1-4d01b278ddf4';

    public static function build()
    {
        return self::fromPayload(Uuid::fromString(self::FAKE_UUID), []);
    }

    protected function buildAggregateId(string $aggregateId)
    {
        return Uuid::fromString($aggregateId);
    }
}
