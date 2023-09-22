<?php

namespace LetmepayIo\Tests\Unit\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Requests\AuthenticationRequest;
use LetmepayIo\Sdk\HttpResources\Responses\AuthenticationResponse;
use PHPUnit\Framework\TestCase;

class AuthenticationRequestTest extends TestCase
{
    private AuthenticationRequest $request;

    protected function setUp(): void
    {
        $this->request = new AuthenticationRequest();
        parent::setUp();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\AuthenticationRequest
     */
    public function testStaticProperties() : void
    {
        $this->assertEquals('/oauth/token', $this->request->path());
        $this->assertEquals('POST', $this->request->method());
        $this->assertEquals(AuthenticationResponse::class, $this->request->responseClass());
        $this->assertTrue($this->request->isAuth());
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\AuthenticationRequest
     */
    public function testBodyWithoutRequiredParams() : void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('The params client_id, client_secret and audience are required.');
        $this->request->body();
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Requests\AuthenticationRequest
     */
    public function testFullBody(): void
    {
       $this->request->setAudience('https://test-audience');
       $this->request->setClientSecret('test-client-secret');
       $this->request->setClientId('test-client-id');
       $this->assertSame(
           [
               'client_id' => 'test-client-id',
               'client_secret' => 'test-client-secret',
               'audience' => 'https://test-audience',
               'grant_type' => 'client_credentials',
           ],
           $this->request->body()
       );
    }
}