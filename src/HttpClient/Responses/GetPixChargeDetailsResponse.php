<?php

namespace LetmepayIo\Sdk\HttpClient\Responses;

class GetPixChargeDetailsResponse implements LMPResponseInterface
{
    private string $id = '';
    private string $qrCode = '';

    public function isOk(): bool
    {
        return true;
    }

    public function setData(array $data): LMPResponseInterface
    {
        $this->id = $data['data']['id'];
        $this->qrCode = $data['data']['qr_code'];

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
    public function getQrCode(): string
    {
        return $this->qrCode;
    }
}
