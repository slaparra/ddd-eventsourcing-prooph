<?php

namespace Core\Domain\Model\Invoice;

use Core\Domain\Model\Track\Track;
use SharedKernel\Domain\Aggregate\Entity;

class InvoiceLine extends Entity
{
    /**
     * @var Invoice
     */
    private $invoice;

    /**
     * @var Track
     */
    private $track;

    /**
     * @var float
     */
    private $unitPrice;

    /**
     * @var int
     */
    private $quantity;

    public function __construct(Invoice $invoice, InvoiceLineId $id, Track $track, float $unitPrice, int $quantity)
    {
        parent::__construct($id);
        $this->invoice = $invoice;
        $this->track = $track;
        $this->unitPrice = $unitPrice;
        $this->quantity = $quantity;
    }

    public function invoice(): Invoice
    {
        return $this->invoice;
    }

    public function track(): Track
    {
        return $this->track;
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
