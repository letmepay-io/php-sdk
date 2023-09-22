<?php

namespace LetmepayIo\Tests\Unit\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Requests\CreatePaymentRequest;
use LetmepayIo\Sdk\HttpResources\Responses\PaymentResponse;
use PHPUnit\Framework\TestCase;

class CreatePaymentRequestTest extends TestCase
{
    private CreatePaymentRequest $request;
    protected function setUp(): void
    {
        $this->request = new CreatePaymentRequest();
        parent::setUp();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\CreatePaymentRequest
     */
    public function testStaticProperties() : void
    {
        $this->assertEquals('/v1/payments', $this->request->path());
        $this->assertEquals('POST', $this->request->method());
        $this->assertEquals(PaymentResponse::class, $this->request->responseClass());
        $this->assertFalse($this->request->isAuth());
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\CreatePaymentRequest
     */
    public function testBodyRequiredParameters() : void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('The key, key_type, amount, payer_tax_id, type, external_id and description parameters are required.');
        $this->request->body();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\CreatePaymentRequest
     */
    public function testZeroAmount() : void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('The amount parameter must to be greater then 0.');

        $this->request->setKey('test@letmepay.io');
        $this->request->setKeyType('email');
        $this->request->setAmount(0);
        $this->request->setPayerTaxId('00000000191');
        $this->request->setType('pix');
        $this->request->setExternalId('test-0001');
        $this->request->setDescription('test payment');

        $this->request->body();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\CreatePaymentRequest
     */
    public function testBody() : void
    {
        $this->request->setKey('test@letmepay.io');
        $this->request->setKeyType('email');
        $this->request->setAmount(12345);
        $this->request->setPayerTaxId('00000000191');
        $this->request->setType('pix');
        $this->request->setExternalId('test-0001');
        $this->request->setDescription('test payment');

        $this->assertSame(
            [
                'key' => 'test@letmepay.io',
                'key_type' => 'email',
                'amount' => '123.45',
                'payer_tax_id' => '00000000191',
                'type' => 'pix',
                'external_id' => 'test-0001',
                'description' => 'test payment',
            ],
            $this->request->body()
        );
    }
}