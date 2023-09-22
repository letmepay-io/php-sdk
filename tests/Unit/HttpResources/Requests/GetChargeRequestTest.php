<?php

namespace LetmepayIo\Tests\Unit\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Requests\GetChargeRequest;
use LetmepayIo\Sdk\HttpResources\Responses\ChargeResponse;
use PHPUnit\Framework\TestCase;

class GetChargeRequestTest extends TestCase
{
    private GetChargeRequest $request;

    protected function setUp(): void
    {
        $this->request = new GetChargeRequest();
        parent::setUp();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\GetChargeRequest
     */
    public function testStaticProperties() : void
    {
        $this->assertEquals('GET', $this->request->method());
        $this->assertEquals(ChargeResponse::class, $this->request->responseClass());
        $this->assertFalse($this->request->isAuth());
        $this->assertNull($this->request->body());
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\GetChargeRequest
     */
    public function testPathWithoutId() : void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('The id parameter is required.');
        $this->request->path();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\GetChargeRequest
     */
    public function testPath() : void
    {
        $this->request->setId('test');
        $this->assertEquals('/v1/charges/test', $this->request->path());
    }
}