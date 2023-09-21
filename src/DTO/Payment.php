<?php

namespace LetmepayIo\Sdk\DTO;

class Payment
{
    private string $id;
    private string $type;
    private string $payerTaxId;
    private string $description;
    private string $keyType;
    private string $key;
    private string $amount;
    private string $status;
    private string $externalId;
    private string $createdAt;
    private string $updatedAt;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id) : self
    {
        $this->id = $id;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type) : self
    {
        $this->type = $type;
        return $this;
    }

    public function getPayerTaxId(): string
    {
        return $this->payerTaxId;
    }

    public function setPayerTaxId(string $payerTaxId) : self
    {
        $this->payerTaxId = $payerTaxId;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description) : self
    {
        $this->description = $description;
        return $this;
    }

    public function getKeyType(): string
    {
        return $this->keyType;
    }

    public function setKeyType(string $keyType) : self
    {
        $this->keyType = $keyType;
        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key) : self
    {
        $this->key = $key;
        return $this;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount) : self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status) : self
    {
        $this->status = $status;
        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId) : self
    {
        $this->externalId = $externalId;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt) : self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt) : self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}