<?php

namespace Core\Domain\Model\Invoice;

use Core\Domain\Model\Customer\CustomerId;
use SharedKernel\Domain\Event\DomainEvent;
use SharedKernel\Domain\ValueObject\Address;

class InvoiceCreatedEvent extends DomainEvent
{
    const CUSTOMER_ID = 'customer_id';
    const BILLING_ADDRESS_STREET = 'billing_address_street';
    const BILLING_ADDRESS_CITY = 'billing_address_city';
    const BILLING_ADDRESS_STATE = 'billing_address_state';
    const BILLING_ADDRESS_COUNTRY = 'billing_address_country';
    const BILLING_ADDRESS_POSTAL_CODE = 'billing_address_postal_code';

    public function getCustomerId(): CustomerId
    {
        return CustomerId::fromString($this->get(self::CUSTOMER_ID));
    }

    public function getBillingAddress(): Address
    {
        return new Address(
            $this->get(self::BILLING_ADDRESS_STREET),
            $this->get(self::BILLING_ADDRESS_CITY),
            $this->get(self::BILLING_ADDRESS_STATE),
            $this->get(self::BILLING_ADDRESS_COUNTRY),
            $this->get(self::BILLING_ADDRESS_POSTAL_CODE)
        );
    }

    protected function buildAggregateId(string $aggregateId)
    {
        return InvoiceId::fromString($aggregateId);
    }
}
