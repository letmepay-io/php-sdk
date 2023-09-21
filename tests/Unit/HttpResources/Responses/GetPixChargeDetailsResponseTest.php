<?php

namespace Unit\HttpResources\Responses;

use LetmepayIo\Sdk\DTO\ChargePixDetails;
use LetmepayIo\Sdk\HttpResources\Responses\GetPixChargeDetailsResponse;
use PHPUnit\Framework\TestCase;

class GetPixChargeDetailsResponseTest extends TestCase
{
    public static function isOkScenarios() : array
    {
        return [
            [['response' => 'error'], false],
            [['response' => 'ok', 'data' => ['id' => 'id', 'qr_code' => 'qr_code']], true],
        ];
    }

    /**
     * @dataProvider isOkScenarios
     * @covers \LetmepayIo\Sdk\HttpResources\Responses\GetPixChargeDetailsResponse
     * @covers \LetmepayIo\Sdk\DTO\ChargePixDetails
     */
    public function testIsOkResponse($data, $expected) : void
    {
        $response = (new GetPixChargeDetailsResponse())->setData($data);
        $this->assertEquals($expected, $response->isOk());
    }

    /**
     * @return void
     * @covers \LetmepayIo\Sdk\HttpResources\Responses\GetPixChargeDetailsResponse
     * @covers \LetmepayIo\Sdk\DTO\ChargePixDetails
     */
    public function testGetPixChargeDetails() : void
    {
        $data = [
            'response' => 'ok',
            'data' => [
                'id' => '77e82017-52a5-4fbe-92ad-ae88c832eaab',
                'qr_code' => 'base64_image_qr_code',
            ],
        ];
        $response = (new GetPixChargeDetailsResponse())->setData($data);
        $details = $response->getChargePixDetails();
        $this->assertTrue($response->isOk());
        $this->assertInstanceOf(ChargePixDetails::class, $details);
        $this->assertEquals('77e82017-52a5-4fbe-92ad-ae88c832eaab', $details->getId());
        $this->assertEquals('base64_image_qr_code', $details->getQrCode());
    }
}