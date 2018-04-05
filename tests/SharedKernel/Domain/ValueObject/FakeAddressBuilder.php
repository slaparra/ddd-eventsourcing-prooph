<?php

namespace Test\SharedKernel\Domain\ValueObject;

use SharedKernel\Domain\ValueObject\Address;

class FakeAddressBuilder
{
    const A_STREET_NAME = 'a street name';
    const CITY = 'Barcelona';
    const A_STATE = 'a state';
    const A_COUNTRY = 'a country';
    const POSTAL_CODE = '8840-8870';

    public static function build()
    {
        return new Address(
            self::A_STREET_NAME,
            self::CITY,
            self::A_STATE,
            self::A_COUNTRY,
            self::POSTAL_CODE
        );
    }
}