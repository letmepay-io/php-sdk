<?php

namespace LetmepayIo\Tests\Unit;

use LetmepayIo\Sdk\VerifyWebhook;
use PHPUnit\Framework\TestCase;

class VerifyWebhookTest extends TestCase
{
    /**
     * @return void
     * @covers \LetmepayIo\Sdk\VerifyWebhook
     */
    public function testWithValidCheckSum() : void
    {
        $this->assertTrue(VerifyWebhook::isValid('test', '0a69ff922690458a29d776305475f11b', 'e923e6421f367efa516baea0df20981846d31ab35583565d46ece11dd1d3806d'));
        $this->assertFalse(VerifyWebhook::isValid('test', '0a69ff922690458a29d776305475f11b', 'test'));
        $this->assertFalse(VerifyWebhook::isValid('test', 'test', 'e923e6421f367efa516baea0df20981846d31ab35583565d46ece11dd1d3806d'));
    }
}