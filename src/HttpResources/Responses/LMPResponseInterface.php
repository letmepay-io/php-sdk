<?php

namespace LetmepayIo\Sdk\HttpResources\Responses;

interface LMPResponseInterface
{
    public function isOk() : bool;
    public function setData(array $data) : self;
}
