<?php

namespace SharedKernel\Domain\Aggregate;

use SharedKernel\Domain\Event\DomainEvent;
use SharedKernel\Common\Uuid;
use SharedKernel\Domain\Event\EventStream;

abstract class AggregateRoot extends Entity
{
    /**
     * @var EventStream
     */
    private $domainEvents;

    protected function __construct(Uuid $id)
    {
        parent::__construct($id);
        $this->domainEvents = EventStream::createEmpty();
    }

    protected function addEvent(DomainEvent $domainEvent)
    {
        $this->domainEvents->add($domainEvent);
    }

    public function pullEvents(): EventStream
    {
        $events = EventStream::createFromArray($this->domainEvents->toArray());
        $this->domainEvents->clear();

        return $events;
    }
}
