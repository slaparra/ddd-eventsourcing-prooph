<?php

namespace SharedKernel\Domain\ValueObject;

use SharedKernel\Common\Assertion\Assertion;

class Email
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        Assertion::email($value);
        $this->value = $value;
    }

    public static function create(string $email)
    {
        return new self($email);
    }

    public function value(): string
    {
        return $this->value;
    }
}
