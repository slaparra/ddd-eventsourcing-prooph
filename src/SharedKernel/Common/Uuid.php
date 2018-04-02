<?php

namespace SharedKernel\Common;

use SharedKernel\Common\Assertion\Assertion;

class Uuid
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromString(string $string)
    {
        Assertion::uuid4($string);

        return new static($string);
    }

    public function toString(): string
    {
        return $this->value;
    }
}
