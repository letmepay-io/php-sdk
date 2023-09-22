<?php

namespace LetmepayIo\Sdk\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Responses\ChargeResponse;

class CreateChargeRequest implements LMPRequestInterface
{
    private string $payerTaxId = '';

    private float $amount = 0.0;

    private string $externalId = '';

    private string $description = '';

    private int $expiration = 0;

    private array $splits = [];

    public function path(): string
    {
        return '/v1/charges';
    }

    public function isAuth(): bool
    {
        return false;
    }

    public function method(): string
    {
        return 'POST';
    }

    public function responseClass(): string
    {
        return ChargeResponse::class;
    }

    public function body(): ?array
    {
        if (
            $this->payerTaxId == '' ||
            $this->amount == 0.0 ||
            $this->externalId == ''
        ) {
            throw new Error('The payer_tax_id, amount and external_id parameters are required.');
        }

        $body = [
            'payer_tax_id' => $this->payerTaxId,
            'amount' => $this->amount,
            'type' => 'pix',
            'external_id' => $this->externalId,
        ];

        if ($this->description != '') {
            $body['description'] = $this->description;
        }

        if (count($this->splits) > 0) {
            $body['splits'] = $this->splits;
        }

        if ($this->expiration > 0) {
            $body['expiration'] = $this->expiration;
        }

        return $body;
    }

    /**
     * @param string $payerTaxId
     * @return CreateChargeRequest
     */
    public function setPayerTaxId(string $payerTaxId): CreateChargeRequest
    {
        $this->payerTaxId = $payerTaxId;
        return $this;
    }

    /**
     * @param float $amount
     * @return CreateChargeRequest
     */
    public function setAmount(float $amount): CreateChargeRequest
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $externalId
     * @return CreateChargeRequest
     */
    public function setExternalId(string $externalId): CreateChargeRequest
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * @param string $description
     * @return CreateChargeRequest
     */
    public function setDescription(string $description): CreateChargeRequest
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param int $expiration
     * @return CreateChargeRequest
     */
    public function setExpiration(int $expiration): CreateChargeRequest
    {
        $this->expiration = $expiration;
        return $this;
    }

    /**
     * @param array $splits
     * @return CreateChargeRequest
     */
    public function setSplits(array $splits): CreateChargeRequest
    {
        $this->splits = $splits;
        return $this;
    }
}
