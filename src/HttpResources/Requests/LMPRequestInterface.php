<?php

namespace LetmepayIo\Sdk\HttpResources\Requests;

interface LMPRequestInterface
{
    public function path(): string;
    public function method(): string;
    public function responseClass(): string;
    public function body(): ?array;
    public function isAuth() : bool;
}
