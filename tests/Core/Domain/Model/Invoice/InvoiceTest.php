<?php

namespace Test\Core\Domain\Model\Invoice;

use Core\Domain\Model\Invoice\Invoice;
use Core\Domain\Model\Invoice\InvoiceCreatedEvent;
use Core\Domain\Model\Invoice\InvoiceId;
use Core\Domain\Model\Invoice\InvoiceLine;
use Core\Domain\Model\Invoice\InvoiceLineAddedEvent;
use Core\Domain\Model\Invoice\InvoiceLineId;
use PHPUnit\Framework\TestCase;
use Test\Core\Domain\Model\Customer\FakeCustomerBuilder;
use Test\Core\Domain\Model\Track\Entity\FakeTrackBuilder;
use Test\SharedKernel\Domain\ValueObject\FakeAddressBuilder;

class InvoiceTest extends TestCase
{
    const FAKE_UNIT_PRICE_IN_INVOICE_LINE = 12.50;
    const FAKE_QUANTITY_IN_INVOICE_LINE = 5;

    /**
     * Given: InvoiceData
     * When:  InvoiceIsCreated
     * Then:  ItShouldRecordInvoiceCreatedEventProperly
     * @test
     */
    public function givenInvoiceDataWhenInvoiceIsCreatedThenItShouldRecordInvoiceCreatedEventProperly()
    {
        $invoice = Invoice::create(
            InvoiceId::fromString('9e79255d-4137-46a9-a1e8-0dcf3d02f613'),
            FakeCustomerBuilder::build(),
            FakeAddressBuilder::build()
        );

        /** @var InvoiceCreatedEvent $invoiceCreatedEvent */
        $invoiceCreatedEvent = $invoice->pullEvents()->first();
        $this->assertInstanceOf(InvoiceCreatedEvent::class, $invoiceCreatedEvent);
        $this->assertEquals($invoiceCreatedEvent->getCustomerId()->toString(), FakeCustomerBuilder::FAKE_CUSTOMER_ID);
        $this->assertEquals($invoiceCreatedEvent->getBillingAddress(), FakeAddressBuilder::build());
    }

    /**
     * Given: InvoiceData
     * When:  InvoiceIsCreated
     * Then:  ItShouldInitializeZeroLInes
     * @test
     */
    public function givenInvoiceDataWhenInvoiceIsCreatedThenItShouldInitializeZeroLInes()
    {
        $invoice = Invoice::create(
            InvoiceId::fromString('9e79255d-4137-46a9-a1e8-0dcf3d02f613'),
            FakeCustomerBuilder::build(),
            FakeAddressBuilder::build()
        );

        $this->assertCount(0, $invoice->invoiceLines());
    }

    /**
     * Given: AnInvoice
     * When:  AnInvoiceLineIsAdded
     * Then:  ItShouldRecordAInvoiceLineAddedEvent
     * @test
     */
    public function givenAnInvoiceWhenAnInvoiceLineIsAddedThenItShouldRecordAInvoiceLineAddedEvent()
    {
        $invoice = FakeInvoiceBuilder::build();

        $invoiceLineId = InvoiceLineId::fromString('c4cbbca0-cc3f-41fd-8778-5b568bafa498');

        $invoice->addInvoiceLine(
            $invoiceLineId,
            FakeTrackBuilder::build(),
            self::FAKE_UNIT_PRICE_IN_INVOICE_LINE,
            self::FAKE_QUANTITY_IN_INVOICE_LINE
        );

        /** @var InvoiceLine $invoiceLineAdded */
        $invoiceLineAdded = $invoice->invoiceLines()->first();

        /** @var InvoiceLineAddedEvent $eventGenerated */
        $eventGenerated = $invoice->pullEvents()->first();

        $this->assertInstanceOf(InvoiceLineAddedEvent::class, $eventGenerated);
        $this->assertEquals($eventGenerated->getInvoiceLineId(), $invoiceLineAdded->id());
        $this->assertEquals($eventGenerated->aggregateRootId(), $invoice->id());
        $this->assertEquals($eventGenerated->trackId(), $invoiceLineAdded->track()->id());
        $this->assertEquals($eventGenerated->quantity(), $invoiceLineAdded->quantity());
        $this->assertEquals($eventGenerated->unitPrice(), self::FAKE_UNIT_PRICE_IN_INVOICE_LINE);
    }

    /**
     * Given: AnInvoice
     * When:  TwoInvoicesLineAreAdded
     * Then:  TotalShouldBeTheUnitPricesAdded
     * @test
     */
    public function givenAnInvoiceWhenTwoInvoicesLineAreAddedThenTotalShouldBeTheUnitPricesAdded()
    {
        $invoice = FakeInvoiceBuilder::build();

        $invoice->addInvoiceLine(
            InvoiceLineId::fromString('c4cbbca0-cc3f-41fd-8778-5b568bafa498'),
            FakeTrackBuilder::build(),
            3.50,
            2
        );

        $invoice->addInvoiceLine(
            InvoiceLineId::fromString('c4cbbca0-cc3f-41fd-8778-5b568bafa498'),
            FakeTrackBuilder::build(),
            4.25,
            3
        );

        $this->assertEquals($invoice->total(), 19.75);
    }
}
