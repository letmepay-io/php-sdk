<?php

namespace LetmepayIo\Tests\Unit\Exceptions;

use LetmepayIo\Sdk\Exceptions\Error;
use PHPUnit\Framework\TestCase;

class ErrorTest extends TestCase
{
    /**
     * @return void
     * @covers \LetmepayIo\Sdk\Exceptions\Error
     */
    public function testErrors() : void
    {
        $error = new Error();
        $error->setErrors(['test' => true]);
        $this->assertSame(['test' => true], $error->getErrors());
    }
}