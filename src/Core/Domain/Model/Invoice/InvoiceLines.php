<?php

namespace Core\Domain\Model\Invoice;

use SharedKernel\Common\Assertion\Assertion;
use SharedKernel\Common\Collection\ArrayCollection;

class InvoiceLines extends ArrayCollection
{
    protected function __construct(array $trackIds)
    {
        Assertion::allIsInstanceOf($trackIds, InvoiceLine::class);
        parent::__construct($trackIds);
    }
}
