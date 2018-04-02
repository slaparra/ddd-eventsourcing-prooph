<?php

namespace Test\SharedKernel\Domain\Event;

use SharedKernel\Common\Assertion\AssertionFailedException;
use SharedKernel\Domain\Event\DomainEvent;
use SharedKernel\Domain\Event\EventStream;
use PHPUnit\Framework\TestCase;

class EventStreamTest extends TestCase
{
    /**
     * Given: AnArray
     * When:  ElementsAreDomainEvents
     * Then:  ItShouldBeCreatedProperly
     * @test
     */
    public function givenAnArrayWhenElementsAreDomainEventsThenItShouldBeCreatedProperly()
    {
        $eventStream = EventStream::createFromArray([FakeDomainEvent::build()]);

        $this->assertContainsOnlyInstancesOf(DomainEvent::class, $eventStream);
    }

    /**
     * Given: AnArray
     * When:  ElementsAreNotDomainEvents
     * Then:  ItShouldThrowAssertionFailedExcepction
     * @test
     */
    public function givenAnArrayWhenElementsAreNotDomainEventsThenItShouldThrowAssertionFailedExcepction()
    {
        $this->expectException(AssertionFailedException::class);

        EventStream::createFromArray(['invalid domain event']);
    }
}
