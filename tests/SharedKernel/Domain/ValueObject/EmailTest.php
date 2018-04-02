<?php

namespace Test\SharedKernel\Domain\ValueObject;

use SharedKernel\Common\Assertion\AssertionFailedException;
use SharedKernel\Domain\ValueObject\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    const FAKE_EMAIL = 'test@email.com';

    /**
     * Given: AnEmail
     * When:  ItIsInvalid
     * Then:  ItShouldThrowAssertionFailedException
     * @test
     */
    public function givenAnEmailWhenItIsInvalidThenItShouldThrowAssertionFailedException()
    {
        $this->expectException(AssertionFailedException::class);

        Email::create('an invalid email');
    }

    /**
     * Given: AnEmail
     * When:  ItIsValid
     * Then:  ItShouldBeCreatedProperly
     * @test
     */
    public function givenAnEmailWhenItIsValidThenItShouldBeCreatedProperly()
    {
        $email = Email::create(self::FAKE_EMAIL);

        $this->assertInstanceOf(Email::class, $email);
        $this->assertEquals($email->value(), self::FAKE_EMAIL);
    }
}
