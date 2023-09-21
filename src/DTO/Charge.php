<?php

namespace LetmepayIo\Sdk\DTO;

class Charge
{
    private string $id;
    private string $type;
    private string $payerTaxId;
    private string $amount;
    private string $externalId;
    private int $expiration;
    private string $paymentUrl;
    private string $description;
    private string $status;
    private ?array $split = [];
    private string $createdAt;
    private string $updatedAt;


    public function setId(string $id) :self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setType(string $type) :self
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setPayerTaxId(string $payerTaxId) :self
    {
        $this->payerTaxId = $payerTaxId;
        return $this;
    }

    public function getPayerTaxId(): string
    {
        return $this->payerTaxId;
    }

    public function setAmount(string $amount) :self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setExternalId(string $externalId) :self
    {
        $this->externalId = $externalId;
        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExpiration(int $expiration) :self
    {
        $this->expiration = $expiration;
        return $this;
    }

    public function getExpiration(): int
    {
        return $this->expiration;
    }

    public function setPaymentUrl(string $paymentUrl) :self
    {
        $this->paymentUrl = $paymentUrl;
        return $this;
    }

    public function getPaymentUrl(): string
    {
        return $this->paymentUrl;
    }

    public function setDescription(string $description) :self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setStatus(string $status) :self
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setSplit(?array $split) :self
    {
        if (!is_null($split)) {
            $this->split = $split;
        }
        return $this;
    }

    public function getSplit(): array
    {
        return $this->split;
    }

    public function setCreatedAt(string $createdAt) :self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(string $updatedAt) :self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

}