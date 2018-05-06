<?php

namespace SharedKernel\Domain\Event;

use SharedKernel\Common\Assertion\Assertion;
use SharedKernel\Common\Collection\ArrayCollection;

final class EventStream extends ArrayCollection
{
    protected function __construct(array $trackIds)
    {
        Assertion::allIsInstanceOf($trackIds, DomainEvent::class);
        parent::__construct($trackIds);
    }
}
