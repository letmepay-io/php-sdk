<?php

namespace LetmepayIo\Sdk\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Responses\GetPixChargeDetailsResponse;

class GetPixChargeDetailsRequest implements LMPRequestInterface
{
    private string $id = '';

    public function path(): string
    {
        if ($this->id == '') {
            throw new Error('The id parameter is required.');
        }
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
