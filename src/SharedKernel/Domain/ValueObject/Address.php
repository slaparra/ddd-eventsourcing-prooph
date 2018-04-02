<?php

namespace SharedKernel\Domain\ValueObject;

use SharedKernel\Common\Assertion\Assertion;

class Address
{
    /**
     * @var string
     */
    private $streetName;

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

    public function __construct(string $streetName, string $city, string $state, string $country, string $postalCode)
    {
        $this->setStreetName($streetName);
        $this->setCity($city);
        $this->state = $state;
        $this->country = $country;
        $this->setPostalCode($postalCode);
    }

    public function streetName(): string
    {
        return $this->streetName;
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

    private function setStreetName(string $streetName): void
    {
        Assertion::minLength($streetName, 5, 'Street name length should be greater than 5');
        $this->streetName = $streetName;
    }

    private function setCity(string $city): void
    {
        Assertion::minLength($city, 5, 'City length should be greater than 5');
        $this->city = $city;
    }

    protected function setPostalCode(string $postalCode): void
    {
        Assertion::nullOrMaxLength($postalCode, 10, 'Postal code should be null or length less than 10');
        $this->postalCode = $postalCode;
    }
}
