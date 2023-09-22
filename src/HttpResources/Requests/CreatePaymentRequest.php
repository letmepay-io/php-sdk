<?php

namespace LetmepayIo\Sdk\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Responses\PaymentResponse;

class CreatePaymentRequest implements LMPRequestInterface
{
    private string $type = '';
    private string $payerTaxId = '';
    private string $description = '';
    private string $keyType = '';
    private string $key = '';
    private string $amount = '';
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

    /**
     * @return array|null
     * @throws Error
     */
    public function body(): ?array
    {
        if (
            $this->key == '' ||
            $this->keyType == '' ||
            $this->amount == '' ||
            $this->payerTaxId == '' ||
            $this->type == '' ||
            $this->externalId == '' ||
            $this->description == ''

        ) {
            throw new Error('The key, key_type, amount, payer_tax_id, type, external_id and description parameters are required.');
        }

        if ($this->amount == '0.00') {
            throw new Error('The amount parameter must to be greater then 0.');
        }

        return [
            'key' => $this->key,
            'key_type' => $this->keyType,
            'amount' => $this->amount,
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
    public function setAmount(int $amount = 0): CreatePaymentRequest
    {
        $sa = (string)$amount;
        $sa = str_pad($sa, 3, '0', STR_PAD_LEFT);
        $sa = substr_replace($sa, '.', -2, -2);
        $this->amount = $sa;
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
