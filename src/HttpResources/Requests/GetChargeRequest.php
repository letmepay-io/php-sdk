<?php

namespace LetmepayIo\Sdk\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Responses\ChargeResponse;

class GetChargeRequest implements LMPRequestInterface
{
    private string $id = '';

    /**
     * @return string
     * @throws Error
     */
    public function path(): string
    {
        if ($this->id == '') {
            throw new Error('The id parameter is required.');
        }
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
