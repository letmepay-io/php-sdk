<?php

namespace LetmepayIo\Sdk\HttpClient\Responses;

class PaymentResponse implements LMPResponseInterface
{
    private string $id = '';
    private string $type = '';
    private string $payerTaxId = '';
    private string $description = '';
    private string $keyType = '';
    private string $key = '';
    private string $amount = '';
    private string $status = '';
    private string $externalId = '';
    private string $createdAt = '';
    private string $updatedAt = '';
    private bool $isOk = false;
    public function isOk(): bool
    {
        return $this->isOk;
    }

    public function setData(array $data): LMPResponseInterface
    {
        $this->isOk = $data['response'] === 'ok';

        $this->id = $data['data']['id'];
        $this->type = $data['data']['type'];
        $this->payerTaxId = $data['data']['payer_tax_id'];
        $this->description = $data['data']['description'];
        $this->keyType = $data['data']['key_type'];
        $this->key = $data['data']['key'];
        $this->amount = $data['data']['amount'];
        $this->status = $data['data']['status'];
        $this->externalId = $data['data']['external_id'];
        $this->createdAt = $data['data']['created_at'];
        $this->updatedAt = $data['data']['updated_at'];

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPayerTaxId(): string
    {
        return $this->payerTaxId;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getKeyType(): string
    {
        return $this->keyType;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
