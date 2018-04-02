<?php

namespace SharedKernel\Common\Assertion;

use Assert\Assertion as BeberleiAssertion;

final class Assertion extends BeberleiAssertion
{
    protected static $exceptionClass = AssertionFailedException::class;

    public static function uuid4(string $uuid)
    {
        parent::uuid($uuid);

        $uuid4pattern = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

        return parent::regex($uuid, $uuid4pattern, sprintf('Value %s is not a valid UUID4', $uuid));
    }
}
