<?php

namespace LetmepayIo\Sdk\HttpResources\Responses;

use FerFabricio\Hydrator\Hydrate;
use LetmepayIo\Sdk\DTO\Charge;

class ChargeResponse implements LMPResponseInterface
{
    private bool $isOk = false;
    private Charge $charge;
    public function setData(array $data): self
    {
        $this->isOk = $data['response'] == 'ok';

        if (array_key_exists('data', $data) && is_array($data['data'])) {
            $this->charge = Hydrate::toObject(Charge::class, $data['data']);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->isOk;
    }

    /**
     * @return Charge
     */
    public function getCharge() : Charge
    {
        return $this->charge;
    }
}
