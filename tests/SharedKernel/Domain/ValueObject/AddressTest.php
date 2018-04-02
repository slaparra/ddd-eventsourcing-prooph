<?php

namespace Test\SharedKernel\Domain\ValueObject;

use SharedKernel\Common\Assertion\AssertionFailedException;
use SharedKernel\Domain\ValueObject\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    const A_STREET_NAME = 'a street name';
    const CITY = 'Barcelona';
    const A_STATE = 'a state';
    const A_COUNTRY = 'a country';
    const POSTAL_CODE = '8840-8870';

    public function testAddressHappyPath()
    {
        $address = new Address(
            self::A_STREET_NAME,
            self::CITY,
            self::A_STATE,
            self::A_COUNTRY,
            self::POSTAL_CODE
        );

        $this->assertEquals(self::A_STREET_NAME, $address->streetName());
        $this->assertEquals(self::CITY, $address->city());
        $this->assertEquals(self::A_STATE, $address->state());
        $this->assertEquals(self::A_COUNTRY, $address->country());
        $this->assertEquals(self::POSTAL_CODE, $address->postalCode());
    }

    /**
     * Given: AStreetName
     * When:  LengthIsNotGreaterThan5
     * Then:  ItShouldThrowAssertionFailedException
     * @test
     */
    public function givenAStreetNameWhenLengthIsNotGreaterThan5ThenItShouldThrowAssertionFailedException()
    {
        $this->expectException(AssertionFailedException::class);

        new Address(
            'abc',
            self::CITY,
            self::A_STATE,
            self::A_COUNTRY,
            self::POSTAL_CODE
        );
    }

    /**
     * Given: ACity
     * When:  LengthIsNotGreaterThan5
     * Then:  ItShouldThrowAssertionFailedException
     * @test
     */
    public function givenACityWhenLengthIsNotGreaterThan5ThenItShouldThrowAssertionFailedException()
    {
        $this->expectException(AssertionFailedException::class);

        new Address(
            self::A_STREET_NAME,
            'city',
            self::A_STATE,
            self::A_COUNTRY,
            self::POSTAL_CODE
        );
    }

    /**
     * Given: APostalCode
     * When:  LengthIsNotNullAndGreaterThan10
     * Then:  ItShouldThrowAssertionFailedException
     * @test
     */
    public function givenAPostalCodeWhenLengthIsNotNullAndGreaterThan10ThenItShouldThrowAssertionFailedException()
    {
        $this->expectException(AssertionFailedException::class);

        new Address(
            self::A_STREET_NAME,
            self::CITY,
            self::A_STATE,
            self::A_COUNTRY,
            'an invalid postal code'
        );
    }
}
