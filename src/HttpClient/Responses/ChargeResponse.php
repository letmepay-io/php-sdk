<?php

namespace LetmepayIo\Sdk\HttpClient\Responses;

class ChargeResponse implements LMPResponseInterface
{
    private string $id = '';
    private string $type = '';
    private string $payerTaxId = '';
    private string $amount = '';
    private string $externalId = '';
    private int $expiration = 0;
    private string $paymentUrl = '';
    private string $description = '';
    private string $status = '';
    private ?array $split = [];
    private string $createdAt = '';
    private string $updatedAt = '';

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPayerTaxId(): string
    {
        return $this->payerTaxId;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function getExpiration(): int
    {
        return $this->expiration;
    }

    public function getPaymentUrl(): string
    {
        return $this->paymentUrl;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSplit(): ?array
    {
        return $this->split;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setData(array $data): self
    {
        $this->id = $data['data']['id'];
        $this->type = $data['data']['type'];
        $this->payerTaxId = $data['data']['payer_tax_id'];
        $this->amount = $data['data']['amount'];
        $this->externalId = $data['data']['external_id'];
        $this->expiration = $data['data']['expiration'];
        $this->paymentUrl = $data['data']['payment_url'];
        $this->description = $data['data']['description'];
        $this->status = $data['data']['status'];
        $this->split = $data['data']['split'];
        $this->createdAt = $data['data']['created_at'];
        $this->updatedAt = $data['data']['updated_at'];

        return $this;
    }

    public function isOk(): bool
    {
        return true;
    }
}
