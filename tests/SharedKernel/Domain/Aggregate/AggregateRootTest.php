<?php

namespace Test\SharedKernel\Domain\Aggregate;

use PHPUnit\Framework\TestCase;
use SharedKernel\Common\Uuid;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use SharedKernel\Domain\Event\DomainEvent;
use Test\SharedKernel\Domain\Event\FakeDomainEvent;

class AggregateRootTest extends TestCase
{
    /**
     * Given: AnAggregate
     * When:  ItIsCreated
     * Then:  EventStreamShouldBeEmpty
     * @test
     */
    public function givenAnAggregateWhenItIsCreatedThenEventStreamShouldBeEmpty()
    {
        $aggregate = new class(Uuid::fromString('03ad41b9-25f2-4f1b-8104-74e99f5b9096')) extends AggregateRoot {
            public function __construct(Uuid $id)
            {
                parent::__construct($id);
            }
        };

        $this->assertEmpty($aggregate->pullEvents());
    }

    /**
     * Given: AUuid
     * When:  AggregateIsCreated
     * Then:  ItShouldGetIdProperly
     * @test
     */
    public function givenAUuidWhenAggregateIsCreatedThenItShouldGetIdProperly()
    {
        $aggregate = new class(Uuid::fromString('03ad41b9-25f2-4f1b-8104-74e99f5b9096')) extends AggregateRoot {
            public function __construct(Uuid $id)
            {
                parent::__construct($id);
            }
        };

        $this->assertEquals($aggregate->id()->toString(), '03ad41b9-25f2-4f1b-8104-74e99f5b9096');
    }

    /**
     * Given: AnAggregate
     * When:  AnEventIsAddedToEventStream
     * Then:  ItShouldBeReturnedOnPullEventsMethodCall
     * @test
     */
    public function givenAnAggregateWhenAnEventIsAddedToEventStreamThenItShouldBeReturnedOnPullEventsMethodCall()
    {
        $aggregate = new class(Uuid::fromString('03ad41b9-25f2-4f1b-8104-74e99f5b9096')) extends AggregateRoot {
            public function __construct(Uuid $id)
            {
                parent::__construct($id);
                $this->addEvent(FakeDomainEvent::fromPayload($id,[]));
            }
        };

        $this->assertContainsOnlyInstancesOf(DomainEvent::class, $aggregate->pullEvents());
    }
}
