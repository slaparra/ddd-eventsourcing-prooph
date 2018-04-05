<?php

namespace Core\Domain\Model\Invoice;

use Core\Domain\Model\Track\Track;
use SharedKernel\Common\Collection\ArrayCollection;
use SharedKernel\Common\Collection\Collection;
use SharedKernel\Domain\Aggregate\AggregateRoot;
use Core\Domain\Model\Customer\Customer;
use SharedKernel\Domain\ValueObject\Address;

class Invoice extends AggregateRoot
{
    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var \DateTimeImmutable
     */
    private $invoiceDate;

    /**
     * @var Address
     */
    private $billingAddress;

    /**
     * @var Collection
     */
    private $invoiceLines;

    protected function __construct(InvoiceId $id, Customer $customer, Address $billingAddress)
    {
        parent::__construct($id);
        $this->invoiceLines = ArrayCollection::createEmpty();
        $this->customer = $customer;
        $this->billingAddress = $billingAddress;
        $this->invoiceLines = ArrayCollection::createEmpty();
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

    public static function create(InvoiceId $id, Customer $customer, Address $billingAddress): Invoice
    {
        return new self($id, $customer, $billingAddress);
    }

    public function customer(): Customer
    {
        return $this->customer;
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
        $invoiceLine = new InvoiceLine(
            $this,
            $invoiceLineId,
            $track,
            $unitPrice,
            $quantity
        );

        $this->invoiceLines->add($invoiceLine);

        $this->addEvent(
            InvoiceLineAddedEvent::fromPayload(
                $this->id(),
                [
                    InvoiceLineAddedEvent::INVOICE_LINE_ID => $invoiceLine->id()->toString(),
                    InvoiceLineAddedEvent::TRACK_ID => $track->id()->toString(),
                    InvoiceLineAddedEvent::UNIT_PRICE => $invoiceLine->unitPrice(),
                    InvoiceLineAddedEvent::QUANTITY => $invoiceLine->quantity()
                ]
            )
        );
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
