<?php

namespace LetmepayIo\Sdk\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Responses\PaymentResponse;

class GetPaymentDetailsRequest implements LMPRequestInterface
{
    private string $id = '';

    public function path(): string
    {
        if ($this->id == '') {
            throw new Error('The id parameter is required.');
        }
        return sprintf('/v1/payments/%s', $this->id);
    }

    public function method(): string
    {
        return 'GET';
    }

    public function responseClass(): string
    {
        return PaymentResponse::class;
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
     * @return GetPaymentDetailsRequest
     */
    public function setId(string $id): GetPaymentDetailsRequest
    {
        $this->id = $id;
        return $this;
    }
}