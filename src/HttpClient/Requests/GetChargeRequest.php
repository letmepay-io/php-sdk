<?php

namespace LetmepayIo\Sdk\HttpClient\Requests;

use LetmepayIo\Sdk\HttpClient\Responses\ChargeResponse;

class GetChargeRequest implements LMPRequestInterface
{
    private string $id = '';

    public function path(): string
    {
        return sprintf('/v1/charges/%s', $this->id);
    }

    public function method(): string
    {
        return 'GET';
    }

    public function responseClass(): string
    {
        return ChargeResponse::class;
    }

    public function body(): ?array
    {
        return null;
    }

    public function isAuth(): bool
    {
        return false;
    }

    /**
     * @param string $id
     * @return GetChargeRequest
     */
    public function setId(string $id): GetChargeRequest
    {
        $this->id = $id;
        return $this;
    }
}
