<?php

namespace LetmepayIo\Sdk\DTO;

class ChargePixDetails
{
    private string $id;
    private string $qrCode;

    /**
     * @param string $id
     * @return ChargePixDetails
     */
    public function setId(string $id): ChargePixDetails
    {
        $this->id = $id;
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
     * @param string $qrCode
     * @return ChargePixDetails
     */
    public function setQrCode(string $qrCode): ChargePixDetails
    {
        $this->qrCode = $qrCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getQrCode(): string
    {
        return $this->qrCode;
    }

}