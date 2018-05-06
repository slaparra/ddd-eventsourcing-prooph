<?php

namespace SharedKernel\Domain\Aggregate;

use Prooph\EventSourcing\AggregateChanged;
use SharedKernel\Domain\Event\DomainEvent;
use SharedKernel\Common\Uuid;
use SharedKernel\Domain\Event\EventStream;

abstract class AggregateRoot extends \Prooph\EventSourcing\AggregateRoot
{
    use EntityIdTrait;

    protected function __construct(Uuid $id)
    {
        $this->setId($id);
    }

    protected function addEvent(DomainEvent $domainEvent)
    {
        $this->recordThat($domainEvent);
    }

    public function pullEvents(): EventStream
    {
        return EventStream::createFromArray($this->popRecordedEvents());
    }

    protected function aggregateId(): string
    {
        return $this->id()->toString();
    }

    protected function apply(AggregateChanged $event): void
    {
        $handler = $this->determineEventHandlerMethodFor($event);

        if (!method_exists($this, $handler)) {
            throw new \RuntimeException(sprintf(
                'Missing event handler method %s for aggregate root %s',
                $handler,
                get_class($this)
            ));
        }

        $this->{$handler}($event);
    }

    protected function determineEventHandlerMethodFor(AggregateChanged $e): string
    {
        return 'when' . implode(array_slice(explode('\\', get_class($e)), -1));
    }
}
