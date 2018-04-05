<?php

namespace Test\Core\Domain\Model\Customer;

use Core\Domain\Model\Customer\Customer;
use Core\Domain\Model\Customer\CustomerId;

class FakeCustomerBuilder
{
    const FAKE_CUSTOMER_ID = 'b3a124a9-e6f0-4edc-9616-cb0e8743914d';

    public static function build()
    {
        return new Customer(
            CustomerId::fromString(self::FAKE_CUSTOMER_ID),
            'Clara',
            'Campoamor'
        );
    }
}
