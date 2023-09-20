<?php

namespace LetmepayIo\Sdk\HttpClient\Requests;

use LetmepayIo\Sdk\HttpClient\Responses\PaymentResponse;

class CreatePaymentRequest implements LMPRequestInterface
{
    private string $type = '';
    private string $payerTaxId = '';
    private string $description = '';
    private string $keyType = '';
    private string $key = '';
    private int $amount = 0;
    private string $externalId = '';

    public function path(): string
    {
        return '/v1/payments';
    }

    public function method(): string
    {
        return 'POST';
    }

    public function responseClass(): string
    {
        return PaymentResponse::class;
    }

    public function body(): ?array
    {
        $sa = (string)$this->amount;
        $sa = str_pad($sa, 3, '0', STR_PAD_LEFT);
        $sa = substr_replace($sa, '.', -2, -2);

        return [
            'key' => $this->key,
            'key_type' => $this->keyType,
            'amount' => $sa,
            'payer_tax_id' => $this->payerTaxId,
            'type' => $this->type,
            'external_id' => $this->externalId,
            'description' => $this->description,
        ];
    }

    public function isAuth(): bool
    {
        return false;
    }

    /**
     * @param string $type
     * @return CreatePaymentRequest
     */
    public function setType(string $type): CreatePaymentRequest
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $payerTaxId
     * @return CreatePaymentRequest
     */
    public function setPayerTaxId(string $payerTaxId): CreatePaymentRequest
    {
        $this->payerTaxId = $payerTaxId;
        return $this;
    }

    /**
     * @param string $description
     * @return CreatePaymentRequest
     */
    public function setDescription(string $description): CreatePaymentRequest
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $keyType
     * @return CreatePaymentRequest
     */
    public function setKeyType(string $keyType): CreatePaymentRequest
    {
        $this->keyType = $keyType;
        return $this;
    }

    /**
     * @param string $key
     * @return CreatePaymentRequest
     */
    public function setKey(string $key): CreatePaymentRequest
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param int $amount
     * @return CreatePaymentRequest
     */
    public function setAmount(int $amount): CreatePaymentRequest
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $externalId
     * @return CreatePaymentRequest
     */
    public function setExternalId(string $externalId): CreatePaymentRequest
    {
        $this->externalId = $externalId;
        return $this;
    }
}
