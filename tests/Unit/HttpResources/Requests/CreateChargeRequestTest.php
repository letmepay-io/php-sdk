<?php

namespace LetmepayIo\Tests\Unit\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Requests\CreateChargeRequest;
use LetmepayIo\Sdk\HttpResources\Responses\ChargeResponse;
use PHPUnit\Framework\TestCase;

class CreateChargeRequestTest extends TestCase
{
    private CreateChargeRequest $request;

    protected function setUp(): void
    {
        $this->request = new CreateChargeRequest();
        parent::setUp();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\CreateChargeRequest
     */
    public function testStaticProperties() : void
    {
        $this->assertEquals('/v1/charges', $this->request->path());
        $this->assertEquals('POST', $this->request->method());
        $this->assertEquals(ChargeResponse::class, $this->request->responseClass());
        $this->assertFalse($this->request->isAuth());
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\CreateChargeRequest
     */
    public function testBodyRequiredParameters() : void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('The payer_tax_id, amount and external_id parameters are required.');
        $this->request->body();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\CreateChargeRequest
     */
    public function testBodyParameters() : void
    {
        $this->request->setPayerTaxId('00000000191');
        $this->request->setAmount(123.45);
        $this->request->setExternalId('test-0001');
        $this->assertSame(
            [
                'payer_tax_id' => '00000000191',
                'amount' => 123.45,
                'type' => 'pix',
                'external_id' => 'test-0001',
            ],
            $this->request->body()
        );
        $this->request->setExpiration(123);
        $this->assertSame(
            [
                'payer_tax_id' => '00000000191',
                'amount' => 123.45,
                'type' => 'pix',
                'external_id' => 'test-0001',
                'expiration' => 123,
            ],
            $this->request->body()
        );
        $this->request->setDescription('description test');
        $this->assertSame(
            [
                'payer_tax_id' => '00000000191',
                'amount' => 123.45,
                'type' => 'pix',
                'external_id' => 'test-0001',
                'description' => 'description test',
                'expiration' => 123,
            ],
            $this->request->body(),
        );
        $this->request->setSplits([[
            'key_type' => 'cpf',
            'key' => '00000000191',
            'percentage' => 10
        ]]);
        $this->assertSame(
            [
                'payer_tax_id' => '00000000191',
                'amount' => 123.45,
                'type' => 'pix',
                'external_id' => 'test-0001',
                'description' => 'description test',
                'splits' => [[
                    'key_type' => 'cpf',
                    'key' => '00000000191',
                    'percentage' => 10
                ]],
                'expiration' => 123,
            ],
            $this->request->body()
        );
    }
}