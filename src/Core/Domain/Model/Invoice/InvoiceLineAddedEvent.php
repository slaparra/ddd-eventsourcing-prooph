<?php

namespace Core\Domain\Model\Invoice;

use Core\Domain\Model\Track\TrackId;
use SharedKernel\Domain\Event\DomainEvent;

class InvoiceLineAddedEvent extends DomainEvent
{
    const INVOICE_LINE_ID = 'invoice_line_id';
    const TRACK_ID = 'track_id';
    const UNIT_PRICE = 'unit_price';
    const QUANTITY = 'quantity';

    public function getInvoiceLineId(): InvoiceLineId
    {
        return InvoiceLineId::fromString($this->get(self::INVOICE_LINE_ID));
    }

    public function trackId(): TrackId
    {
        return TrackId::fromString($this->get(self::TRACK_ID));
    }

    public function unitPrice(): float
    {
        return $this->get(self::UNIT_PRICE);
    }

    public function quantity(): int
    {
        return $this->get(self::QUANTITY);
    }

    protected function buildAggregateId(string $aggregateId)
    {
        return InvoiceId::fromString($aggregateId);
    }
}
