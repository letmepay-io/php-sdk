<?php

namespace LetmepayIo\Tests\Unit\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Requests\GetPixChargeDetailsRequest;
use LetmepayIo\Sdk\HttpResources\Responses\GetPixChargeDetailsResponse;
use PHPUnit\Framework\TestCase;

class GetPixChargeDetailsRequestTest extends TestCase
{
    private GetPixChargeDetailsRequest $request;

    protected function setUp(): void
    {
        $this->request = new GetPixChargeDetailsRequest();
        parent::setUp();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\GetPixChargeDetailsRequest
     */
    public function testStaticProperties() : void
    {
        $this->assertEquals('GET', $this->request->method());
        $this->assertEquals(GetPixChargeDetailsResponse::class, $this->request->responseClass());
        $this->assertFalse($this->request->isAuth());
        $this->assertNull($this->request->body());
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\GetPixChargeDetailsRequest
     */
    public function testPathWithoutId() : void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('The id parameter is required.');
        $this->request->path();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\GetPixChargeDetailsRequest
     */
    public function testPath() : void
    {
        $this->request->setId('test');
        $this->assertEquals('/v1/charges/test/pix', $this->request->path());
    }
}