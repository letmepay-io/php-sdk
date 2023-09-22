<?php

namespace LetmepayIo\Tests\Unit\DTO;

use LetmepayIo\Sdk\DTO\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @return void
     * @covers \LetmepayIo\Sdk\DTO\Config
     */
    public function testWithData() : void
    {
        $config = new Config(
            'auth_url',
            'base_url',
            'client_id',
            'client_secret'
        );
        $this->assertEquals('auth_url', $config->getAuthUrl());
        $this->assertEquals('base_url', $config->getBaseUrl());
        $this->assertEquals('client_id', $config->getClientId());
        $this->assertEquals('client_secret', $config->getClientSecret());
    }
}