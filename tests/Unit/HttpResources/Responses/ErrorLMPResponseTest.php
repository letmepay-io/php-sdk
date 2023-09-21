<?php

namespace Unit\HttpResources\Responses;

use LetmepayIo\Sdk\HttpResources\Responses\ErrorLMPResponse;
use PHPUnit\Framework\TestCase;

class ErrorLMPResponseTest extends TestCase
{
    public static function isOkScenarios() : array
    {
        return [
            [['response' => 'error'], false],
            [['response' => 'ok'], false],
        ];
    }

    /**
     * @dataProvider isOkScenarios
     * @covers \LetmepayIo\Sdk\HttpResources\Responses\ErrorLMPResponse
     */
    public function testIsOkResponse($data, $expected) : void
    {
        $response = (new ErrorLMPResponse())->setData($data);
        $this->assertEquals($expected, $response->isOk());
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Responses\ErrorLMPResponse
     */
    public function testResponse() : void
    {
        $data = [
            'status' => 'error',
            'message' => 'validation error',
            'errors' => [
                'payer_tax_id' => 'invalid document'
            ],
            'debug_trace_id' => 'localhost/plhFxck4cO-000092'
        ];

        $response = (new ErrorLMPResponse())->setData($data);
        $this->assertEquals('localhost/plhFxck4cO-000092', $response->getDebugTraceId());
        $this->assertEquals('validation error', $response->getMessage());
        $this->assertSame(['payer_tax_id' => 'invalid document'], $response->getErrors());
        $this->assertEquals('error', $response->getStatus());
    }
}