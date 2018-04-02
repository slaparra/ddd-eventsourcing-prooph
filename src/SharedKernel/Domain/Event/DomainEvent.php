<?php

namespace SharedKernel\Domain\Event;

use SharedKernel\Common\Assertion\Assertion;
use SharedKernel\Common\Assertion\AssertionFailedException;
use SharedKernel\Common\Collection\ArrayCollection;
use SharedKernel\Common\Collection\Collection;
use SharedKernel\Common\Uuid;

class DomainEvent
{
    const DOMAIN_EVENT_DATETIME_FORMAT = \DateTime::ISO8601;
    const KEY_ENTITY_ID = 'entity_id';

    /**
     * @var Uuid
     */
    private $aggregateRootId;

    /**
     * @var Collection
     */
    private $payload;

    /**
     * @var \DateTimeImmutable
     */
    private $occurredOn;

    private function __construct(Uuid $aggregateRootId, array $payload)
    {
        $this->aggregateRootId = $aggregateRootId;
        $this->occurredOn = new \DateTimeImmutable();
        $this->payload = ArrayCollection::createFromArray(
            $this->appendAggregateRootIdToPayload($payload)
        );
    }

    private function appendAggregateRootIdToPayload(array $payload): array
    {
        $payload[self::KEY_ENTITY_ID] = $this->aggregateRootId->toString();

        return $payload;
    }

    public static function fromPayload(Uuid $entityId, array $payload): self
    {
        return new static($entityId, $payload);
    }

    public function aggregateRootId(): Uuid
    {
        return $this->aggregateRootId;
    }

    public function payload(): Collection
    {
        return $this->payload;
    }

    public function get(string $key)
    {
        $this->assertEventContainsKeyInPayload($key);

        return $this->payload[$key];
    }

    /**
     * @param string $key
     * @throws AssertionFailedException
     */
    private function assertEventContainsKeyInPayload(string $key): void
    {
        Assertion::true(
            $this->payload->containsKey($key),
            sprintf(
                "Event %s does not contain payload with key '%s'.",
                $this->getEventClassName(),
                $key
            )
        );
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function getEventClassName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}
