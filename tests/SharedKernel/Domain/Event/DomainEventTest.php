<?php

namespace Test\SharedKernel\Domain\Event;

use SharedKernel\Common\Assertion\AssertionFailedException;
use SharedKernel\Domain\Event\DomainEvent;
use PHPUnit\Framework\TestCase;
use Test\SharedKernel\Common\FakeUuidBuilder;

class DomainEventTest extends TestCase
{
    /**
     * Given: AUuid
     * When:  FromPayloadIsCalled
     * Then:  ItShouldReturnADomainEventInstance
     * @test
     */
    public function givenAUuidWhenFromPayloadIsCalledThenItShouldReturnADomainEventInstance()
    {
        $aggregateRootId = FakeUuidBuilder::build();
        $domainEvent = DomainEvent::fromPayload($aggregateRootId, []);

        $this->assertInstanceOf(DomainEvent::class, $domainEvent);
        $this->assertEquals($aggregateRootId, $domainEvent->aggregateRootId());
    }

    /**
     * Given: AUuid
     * When:  GetPayloadMethodIsCalled
     * Then:  ItShouldHasAggregateRootIdWithEntityIdKey
     * @test
     */
    public function givenAUuidWhenGetPayloadMethodIsCalledThenItShouldHasAggregateRootIdWithEntityIdKey()
    {
        $aggregateRootId = FakeUuidBuilder::build();
        $domainEvent = DomainEvent::fromPayload($aggregateRootId, []);

        $this->assertArrayHasKey(DomainEvent::KEY_ENTITY_ID, $domainEvent->payload());
    }

    /**
     * Given:    ADomainEvent
     * ItShould: ReturnAValidPayLoadCollection
     * @test
     */
    public function givenADomainEventItShouldReturnAValidPayLoadCollection()
    {
        $aggregateRootId = FakeUuidBuilder::build();
        $aPayload = ['aKey' => 'aValue', 'aSecondKey' => 'aSecondValue'];
        $domainEvent = DomainEvent::fromPayload($aggregateRootId, $aPayload);

        $expectedPayload = array_merge($aPayload, [DomainEvent::KEY_ENTITY_ID => $aggregateRootId->toString()]);

        $this->assertEquals($expectedPayload, $domainEvent->payload()->toArray());
    }

    /**
     * Given: ADomainEvent
     * When:  GetMethodIsCalled
     * Then:  ItShouldReturnTheProperValue
     * @test
     */
    public function givenADomainEventWhenGetMethodIsCalledThenItShouldReturnTheProperValue()
    {
        $aggregateRootId = FakeUuidBuilder::build();
        $aPayload = ['aKey' => 'aValue'];
        $domainEvent = DomainEvent::fromPayload($aggregateRootId, $aPayload);

        $this->assertEquals('aValue', $domainEvent->get('aKey'));
    }

    /**
     * Given: ADomainEvent
     * When:  GetMethodDoesNotFindTheKeyRequested
     * Then:  ItShouldThrowAssertionFailedException
     * @test
     */
    public function givenADomainEventWhenGetMethodDoesNotFindTheKeyRequestedThenItShouldThrowAssertionFailedException()
    {
        $domainEvent = DomainEvent::fromPayload(FakeUuidBuilder::build(), []);

        $this->expectException(AssertionFailedException::class);

        $domainEvent->get('notExistingkey');
    }

    /**
     * Given:    ADomainEvent
     * ItShould: RegisterTheCreatedDateTime
     * @test
     */
    public function givenADomainEventItShouldRegisterTheCreatedDateTime()
    {
        $aggregateRootId = FakeUuidBuilder::build();
        $expectedDateTime = new \DateTimeImmutable();
        $domainEvent = DomainEvent::fromPayload($aggregateRootId, []);

        $this->assertEquals($expectedDateTime->getTimestamp(), $domainEvent->occurredOn()->getTimestamp(), '', 2);
    }
}
