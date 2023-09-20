<?php

namespace LetmepayIo\Sdk\HttpClient\Responses;

interface LMPResponseInterface
{
    public function isOk() : bool;
    public function setData(array $data) : self;
}
