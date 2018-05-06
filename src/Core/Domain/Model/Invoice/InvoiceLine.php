<?php

namespace Core\Domain\Model\Invoice;

use Core\Domain\Model\Track\Track;
use Core\Domain\Model\Track\TrackId;
use SharedKernel\Domain\Aggregate\EntityIdTrait;

class InvoiceLine
{
    use EntityIdTrait;

    /**
     * @var Invoice
     */
    private $invoice;

    /**
     * @var TrackId
     */
    private $trackId;

    /**
     * @var float
     */
    private $unitPrice;

    /**
     * @var int
     */
    private $quantity;

    public function __construct(Invoice $invoice, InvoiceLineId $id, TrackId $trackId, float $unitPrice, int $quantity)
    {
        $this->setId($id);
        $this->invoice = $invoice;
        $this->trackId = $trackId;
        $this->unitPrice = $unitPrice;
        $this->quantity = $quantity;
    }

    public function invoice(): Invoice
    {
        return $this->invoice;
    }

    public function trackId(): TrackId
    {
        return $this->trackId;
    }

    public function unitPrice(): float
    {
        return $this->unitPrice;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}
