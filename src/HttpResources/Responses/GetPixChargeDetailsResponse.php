<?php

namespace LetmepayIo\Sdk\HttpResources\Responses;

use FerFabricio\Hydrator\Hydrate;
use LetmepayIo\Sdk\DTO\ChargePixDetails;

class GetPixChargeDetailsResponse implements LMPResponseInterface
{
    private bool $isOk = false;

    private ChargePixDetails $chargePixDetails;

    /**
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->isOk;
    }

    /**
     * @return ChargePixDetails
     */
    public function getChargePixDetails(): ChargePixDetails
    {
        return $this->chargePixDetails;
    }

    /**
     * @param array $data
     * @return LMPResponseInterface
     */
    public function setData(array $data): LMPResponseInterface
    {
        if (
            array_key_exists('response', $data) &&
            array_key_exists('data', $data) &&
            array_key_exists('id', $data['data']) &&
            array_key_exists('qr_code', $data['data'])
        ) {
            $this->isOk = $data['response'] === 'ok';
            $this->chargePixDetails = Hydrate::toObject(ChargePixDetails::class, $data['data']);
        }

        return $this;
    }
}
