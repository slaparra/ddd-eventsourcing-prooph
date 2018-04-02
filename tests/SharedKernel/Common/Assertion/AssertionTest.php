<?php

namespace Test\SharedKernel\Common\Assertion;

use PHPUnit\Framework\TestCase;
use SharedKernel\Common\Assertion\Assertion;
use SharedKernel\Common\Assertion\AssertionFailedException;

class AssertionTest extends TestCase
{
    /**
     * @param $validUuid
     * @dataProvider getValidUuid4
     */
    public function testValidUuid4($validUuid)
    {
        $this->assertTrue(Assertion::uuid4($validUuid));
    }

    /**
     * @param $uuidNot4
     * @dataProvider getInValidUuid4
     */
    public function testInvalidUuid4(string $uuidNot4): void
    {
        $this->expectException(AssertionFailedException::class);

        Assertion::uuid4($uuidNot4);
    }
    public function getValidUuid4()
    {
        return [
            ['8c2cc091-182f-4ee1-b161-ea851f95650e'],
            ['e0f9f3f2-4d48-4e94-9cce-4dc71ccd81f8'],
            ['89809ec6-29c3-4f4e-9d4f-2a5f97b12ca1'],
            ['f87d5fef-a821-42f7-ba38-2c1f90b78077'],
            ['79c44c66-fdaf-4d0e-bce3-99f4e44d17c8'],
            ['8887ddea-584d-4cc2-91c7-068d0d4ff671'],
            ['c3269a4a-997f-4620-acef-a3e74d233d9e'],
            ['a97feefd-2cad-46a4-b105-c3e76da785d0'],
        ];
    }

    public function getInValidUuid4()
    {
        return [
            'uuid3_1' => [ 'a3bb189e-8bf9-3888-9912-ace4e6543002' ],
            'uuid3_2' => [ '25e8c301-079b-3ad0-aa9d-72c3b9bc2808' ],
            'uuid3_3' => [ '43b5efd7-a64f-38eb-845a-739fdf0ddeeb' ],
            'uuid3_4' => [ '30373561-6230-3763-2d38-3337332d3465' ],
            'uuid3_5' => [ '6c00cb80-f31c-323f-a6b5-94337df99204' ],
            'uuid3_6' => [ '9e542961-194d-32c8-8dbb-0cadcc361804' ],
            'uuid5_1' => [ 'e6848b7f-8b1d-5fe7-adcc-3a49151737a2' ],
            'uuid5_2' => [ '505fe52f-d6b1-57f9-90cf-0e23c8e528d1' ],
            'uuid5_3' => [ 'ce1f60ad-bb8f-52dc-9c83-f9a0964026c6' ],
            'uuid5_4' => [ '1eaee31c-10c8-54dc-956c-9295db3bf0f9' ],
            'unknown_1' => [ 'c135a15a-3cf2-9582-b0c9-1772a609de7d' ],
            'unknown_2' => [ 'dea027aa-9d46-11e7-abc4-cec278b6b50a' ],
        ];
    }
}
