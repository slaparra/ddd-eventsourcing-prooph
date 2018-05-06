<?php

namespace SharedKernel\Domain\Event;

use Prooph\EventSourcing\AggregateChanged;
use SharedKernel\Common\Assertion\Assertion;
use SharedKernel\Common\Assertion\AssertionFailedException;
use SharedKernel\Common\Uuid;

abstract class DomainEvent extends AggregateChanged
{
    const DOMAIN_EVENT_DATETIME_FORMAT = \DateTime::ISO8601;

    protected function __construct(Uuid $aggregateRootId, array $payload)
    {
        parent::__construct($aggregateRootId->toString(), $payload);
    }

    public static function fromPayload(Uuid $aggregateRootId, array $payload): self
    {
        return new static($aggregateRootId, $payload);
    }

    public function aggregateRootId(): Uuid
    {
        return $this->buildAggregateId(parent::aggregateId());
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Assert\AssertionFailedException
     * @throws \ReflectionException
     */
    public function get(string $key)
    {
        $this->assertEventContainsKeyInPayload($key);

        return $this->payload[$key];
    }

    /**
     * @param string $key
     * @throws AssertionFailedException
     * @throws \Assert\AssertionFailedException
     * @throws \ReflectionException
     */
    private function assertEventContainsKeyInPayload(string $key): void
    {
        Assertion::true(
            isset($this->payload[$key]),
            sprintf(
                "Event %s does not contain payload with key '%s'.",
                $this->getEventClassName(),
                $key
            )
        );
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getEventClassName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    abstract protected function buildAggregateId(string $aggregateId);
}
