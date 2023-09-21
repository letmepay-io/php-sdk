<?php

namespace Unit\HttpResources\Responses;

use LetmepayIo\Sdk\DTO\Charge;
use LetmepayIo\Sdk\DTO\Payment;
use LetmepayIo\Sdk\HttpResources\Responses\ChargeResponse;
use LetmepayIo\Sdk\HttpResources\Responses\PaymentResponse;
use PHPUnit\Framework\TestCase;

class PaymentResponseTest extends TestCase
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
     * @covers \LetmepayIo\Sdk\HttpResources\Responses\PaymentResponse
     */
    public function testIsOkResponse($data, $expected) : void
    {
        $response = (new PaymentResponse())->setData($data);
        $this->assertEquals($expected, $response->isOk());
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Responses\PaymentResponse
     * @covers \LetmepayIo\Sdk\DTO\Payment
     */
    public function testGetCharge() : void
    {
        $data = [
            'response' => 'ok',
            'data' => [
                'id' => '77e82017-52a5-4fbe-92ad-ae88c832eaab',
                'type' => 'pix',
                'payer_tax_id' => '000000000191',
                'description' => 'test description',
                'key_type' => 'cpf',
                'key' => '000000000191',
                'amount' => '100',
                'status' => 'initial',
                'external_id' => 'ZPCDLuZzx0Om6mx',
                'created_at' => '2023-09-21T02:51:24.254373Z',
                'updated_at' => '2023-09-21T02:51:24.254373Z',
            ],
        ];
        $response = (new PaymentResponse())->setData($data);
        $payment = $response->getPayment();
        $this->assertTrue($response->isOk());
        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertEquals('77e82017-52a5-4fbe-92ad-ae88c832eaab', $payment->getId());
        $this->assertEquals('pix', $payment->getType());
        $this->assertEquals('000000000191', $payment->getPayerTaxId());
        $this->assertEquals('100', $payment->getAmount());
        $this->assertEquals('ZPCDLuZzx0Om6mx', $payment->getExternalId());
        $this->assertEquals('test description', $payment->getDescription());
        $this->assertEquals('initial', $payment->getStatus());
        $this->assertEquals('2023-09-21T02:51:24.254373Z', $payment->getCreatedAt());
        $this->assertEquals('2023-09-21T02:51:24.254373Z', $payment->getUpdatedAt());
        $this->assertEquals('cpf', $payment->getKeyType());
        $this->assertEquals('000000000191', $payment->getKey());
    }
}