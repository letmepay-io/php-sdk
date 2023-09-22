<?php

namespace LetmepayIo\Tests\Unit\DTO\Responses;

use LetmepayIo\Sdk\DTO\Charge;
use LetmepayIo\Sdk\HttpResources\Responses\ChargeResponse;
use PHPUnit\Framework\TestCase;

class ChargeResponseTest extends TestCase
{
    public static function isOkScenarios() : array
    {
        return [
            [['response' => 'error'], false],
            [['response' => 'ok'], true],
        ];
    }

    /**
     * @dataProvider isOkScenarios
     * @covers \LetmepayIo\Sdk\HttpResources\Responses\ChargeResponse
     */
    public function testIsOkResponse($data, $expected) : void
    {
        $response = (new ChargeResponse())->setData($data);
        $this->assertEquals($expected, $response->isOk());
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Responses\ChargeResponse
     * @covers \LetmepayIo\Sdk\DTO\Charge
     */
    public function testGetCharge() : void
    {
        $data = [
            'response' => 'ok',
            'data' => [
                'id' => '77e82017-52a5-4fbe-92ad-ae88c832eaab',
                'type' => 'pix',
                'payer_tax_id' => '000000000191',
                'amount' => '100',
                'external_id' => 'ZPCDLuZzx0Om6mx',
                'expiration' => 0,
                'payment_url' => 'https://api.sandbox.letmepay.io/v1/charges/77e82017-52a5-4fbe-92ad-ae88c832eaab/image',
                'description' => 'test description',
                'status' => 'initial',
                'split' => [
                    [
                        'id' => 'ff91d558-9d5e-4bec-8e51-29de7074df03',
                        'key' => '00000000191',
                        'key_type' => 'cpf',
                        'percentage' => '0',
                        'amount' => '20.5',
                        'external_id' => 'ZPCDLuZzx0Om6mx-FkXJZmEEPN',
                        'payer_tax_id' => '05852983942',
                        'charge_id' => '77e82017-52a5-4fbe-92ad-ae88c832eaab',
                        'created_at' => '2023-09-21T02:51:24.374558Z',
                        'updated_at' => '2023-09-21T02:51:24.374558Z'
                    ]
                ],
                'created_at' => '2023-09-21T02:51:24.254373Z',
                'updated_at' => '2023-09-21T02:51:24.254373Z',
            ],
        ];
        $response = (new ChargeResponse())->setData($data);
        $charge = $response->getCharge();
        $this->assertTrue($response->isOk());
        $this->assertInstanceOf(Charge::class, $charge);
        $this->assertEquals('77e82017-52a5-4fbe-92ad-ae88c832eaab', $charge->getId());
        $this->assertEquals('pix', $charge->getType());
        $this->assertEquals('000000000191', $charge->getPayerTaxId());
        $this->assertEquals('100', $charge->getAmount());
        $this->assertEquals('ZPCDLuZzx0Om6mx', $charge->getExternalId());
        $this->assertEquals(0, $charge->getExpiration());
        $this->assertEquals( 'https://api.sandbox.letmepay.io/v1/charges/77e82017-52a5-4fbe-92ad-ae88c832eaab/image', $charge->getPaymentUrl());
        $this->assertEquals('test description', $charge->getDescription());
        $this->assertEquals('initial', $charge->getStatus());
        $this->assertSame([
            [
                'id' => 'ff91d558-9d5e-4bec-8e51-29de7074df03',
                'key' => '00000000191',
                'key_type' => 'cpf',
                'percentage' => '0',
                'amount' => '20.5',
                'external_id' => 'ZPCDLuZzx0Om6mx-FkXJZmEEPN',
                'payer_tax_id' => '05852983942',
                'charge_id' => '77e82017-52a5-4fbe-92ad-ae88c832eaab',
                'created_at' => '2023-09-21T02:51:24.374558Z',
                'updated_at' => '2023-09-21T02:51:24.374558Z'
            ]
        ], $charge->getSplit());
        $this->assertEquals('2023-09-21T02:51:24.254373Z', $charge->getCreatedAt());
        $this->assertEquals('2023-09-21T02:51:24.254373Z', $charge->getUpdatedAt());
    }
}