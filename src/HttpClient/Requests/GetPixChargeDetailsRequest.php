<?php

namespace LetmepayIo\Sdk\HttpClient\Requests;

use LetmepayIo\Sdk\HttpClient\Responses\GetPixChargeDetailsResponse;

class GetPixChargeDetailsRequest implements LMPRequestInterface
{
    private string $id = '';

    public function path(): string
    {
        return sprintf('/v1/charges/%s/pix', $this->id);
    }

    public function method(): string
    {
        return 'GET';
    }

    public function responseClass(): string
    {
        return GetPixChargeDetailsResponse::class;
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
     * @return GetPixChargeDetailsRequest
     */
    public function setId(string $id): GetPixChargeDetailsRequest
    {
        $this->id = $id;
        return $this;
    }
}
