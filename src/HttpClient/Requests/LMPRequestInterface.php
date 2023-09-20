<?php

namespace LetmepayIo\Sdk\HttpClient\Requests;

interface LMPRequestInterface
{
    public function path(): string;
    public function method(): string;
    public function responseClass(): string;
    public function body(): ?array;
    public function isAuth() : bool;
}
