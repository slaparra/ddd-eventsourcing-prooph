<?php

namespace SharedKernel\Domain\ValueObject;

use SharedKernel\Common\Assertion\Assertion;

class Address
{
    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $postalCode;

    public function __construct(string $street, string $city, string $state, string $country, string $postalCode)
    {
        $this->setStreet($street);
        $this->setCity($city);
        $this->state = $state;
        $this->country = $country;
        $this->setPostalCode($postalCode);
    }

    public function street(): string
    {
        return $this->street;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function postalCode(): string
    {
        return $this->postalCode;
    }

    private function setStreet(string $streetName): void
    {
        Assertion::minLength($streetName, 5, 'Street name length should be greater than 5');
        $this->street = $streetName;
    }

    private function setCity(string $city): void
    {
        Assertion::minLength($city, 5, 'City length should be greater than 5');
        $this->city = $city;
    }

    private function setPostalCode(string $postalCode): void
    {
        Assertion::nullOrMaxLength($postalCode, 10, 'Postal code should be null or length less than 10');
        $this->postalCode = $postalCode;
    }
}
