<?php

namespace Core\Domain\Model\Invoice;

use Core\Domain\Model\Customer\CustomerId;
use Core\Domain\Model\Track\Track;
use SharedKernel\Common\Collection\ArrayCollection;
use SharedKernel\Common\Collection\Collection;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use Core\Domain\Model\Customer\Customer;
use SharedKernel\Domain\ValueObject\Address;

class Invoice extends AggregateRoot
{
    /**
     * @var CustomerId
     */
    private $customerId;

    /**
     * @var \DateTimeImmutable
     */
    private $invoiceDate;

    /**
     * @var Address
     */
    private $billingAddress;

    /**
     * @var InvoiceLines
     */
    private $invoiceLines;

    protected function __construct(InvoiceId $id, Customer $customer, Address $billingAddress)
    {
        parent::__construct($id);

        $this->addEvent(
            InvoiceCreatedEvent::fromPayload(
                $this->id(),
                [
                    InvoiceCreatedEvent::CUSTOMER_ID => $customer->id()->toString(),
                    InvoiceCreatedEvent::BILLING_ADDRESS_STREET => $billingAddress->street(),
                    InvoiceCreatedEvent::BILLING_ADDRESS_CITY => $billingAddress->city(),
                    InvoiceCreatedEvent::BILLING_ADDRESS_STATE => $billingAddress->state(),
                    InvoiceCreatedEvent::BILLING_ADDRESS_COUNTRY => $billingAddress->country(),
                    InvoiceCreatedEvent::BILLING_ADDRESS_POSTAL_CODE => $billingAddress->postalCode()
                ]
            )
        );
    }

    protected function whenInvoiceCreatedEvent(InvoiceCreatedEvent $invoiceCreatedEvent)
    {
        $this->customerId = $invoiceCreatedEvent->getCustomerId();
        $this->billingAddress = $invoiceCreatedEvent->getBillingAddress();
        $this->invoiceLines = InvoiceLines::createEmpty();
    }

    public static function create(InvoiceId $id, Customer $customer, Address $billingAddress): Invoice
    {
        return new self($id, $customer, $billingAddress);
    }

    public function customerId(): CustomerId
    {
        return $this->customerId;
    }

    public function invoiceDate(): \DateTimeImmutable
    {
        return $this->invoiceDate;
    }

    public function billingAddress(): Address
    {
        return $this->billingAddress;
    }

    public function total(): string
    {
        return array_reduce(
            $this->invoiceLines->toArray(),
            function (float $carry, InvoiceLine $invoiceLine) {
                return ((float) $carry + ($invoiceLine->unitPrice()*$invoiceLine->quantity()));
            },
            0
        );
    }

    public function addInvoiceLine(
        InvoiceLineId $invoiceLineId,
        Track $track,
        float $unitPrice,
        int $quantity
    ): void {
        $this->addEvent(
            InvoiceLineAddedEvent::fromPayload(
                $this->id(),
                [
                    InvoiceLineAddedEvent::INVOICE_LINE_ID => $invoiceLineId->toString(),
                    InvoiceLineAddedEvent::TRACK_ID => $track->id()->toString(),
                    InvoiceLineAddedEvent::UNIT_PRICE => $unitPrice,
                    InvoiceLineAddedEvent::QUANTITY => $quantity
                ]
            )
        );
    }

    protected function whenInvoiceLineAddedEvent(InvoiceLineAddedEvent $invoiceLineAddedEvent)
    {
        $invoiceLine = new InvoiceLine(
            $this,
            $invoiceLineAddedEvent->getInvoiceLineId(),
            $invoiceLineAddedEvent->trackId(),
            $invoiceLineAddedEvent->unitPrice(),
            $invoiceLineAddedEvent->quantity()
        );

        $this->invoiceLines->add($invoiceLine);
    }

    public function removeInvoiceLine(InvoiceLine $invoiceLine)
    {
        $this->invoiceLines->removeElement($invoiceLine);
    }

    public function invoiceLines(): Collection
    {
        return $this->invoiceLines;
    }
}
