<?php

namespace Unit\HttpResources\Responses;

use LetmepayIo\Sdk\HttpResources\Responses\AuthenticationResponse;
use PHPUnit\Framework\TestCase;

class AuthenticationResponseTest extends TestCase
{
    public static function isOkScenarios() : array
    {
        return [
            [['response' => 'error'], false],
            [['access_token' => '', 'scope' => '', 'expires_in' => 0, 'token_type' => ''], true],
            [['access_token' => '', 'scope' => '', 'expires_in' => '', 'token_type' => ''], false],
        ];
    }

    /**
     * @dataProvider isOkScenarios
     * @covers \LetmepayIo\Sdk\HttpResources\Responses\AuthenticationResponse
     */
    public function testIsOkResponse($data, $expected) : void
    {
        $response = (new AuthenticationResponse())->setData($data);
        $this->assertEquals($expected, $response->isOk());
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Responses\AuthenticationResponse
     */
    public function testGetters() : void
    {
        $data = [
            'access_token' => 'test_access_token',
            'scope' => 'test_scope',
            'expires_in' => 1230,
            'token_type' => 'test_token_type'
        ];
        $response = (new AuthenticationResponse())->setData($data);
        $this->assertEquals('test_access_token', $response->getAccessToken());
        $this->assertEquals('test_scope', $response->getScope());
        $this->assertEquals(1230, $response->getExpiresIn());
        $this->assertEquals('test_token_type', $response->getTokenType());
    }
}