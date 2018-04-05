<?php

namespace Test\Core\Domain\Model\Invoice;

use Core\Domain\Model\Invoice\Invoice;
use Core\Domain\Model\Invoice\InvoiceId;
use Test\Core\Domain\Model\Customer\FakeCustomerBuilder;
use Test\SharedKernel\Domain\ValueObject\FakeAddressBuilder;

class FakeInvoiceBuilder
{
    const FAKE_ID = '9de56b0a-c835-437f-b1c8-789e24ae6bc4';

    public static function build()
    {
        $invoice = Invoice::create(
            InvoiceId::fromString(self::FAKE_ID),
            FakeCustomerBuilder::build(),
            FakeAddressBuilder::build()
        );

        $invoice->pullEvents();

        return $invoice;
    }
}
