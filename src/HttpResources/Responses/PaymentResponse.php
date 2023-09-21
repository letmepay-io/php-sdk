<?php

namespace LetmepayIo\Sdk\HttpResources\Responses;

use FerFabricio\Hydrator\Hydrate;
use LetmepayIo\Sdk\DTO\Payment;

class PaymentResponse implements LMPResponseInterface
{
    private bool $isOk = false;
    private Payment $payment;

    /**
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->isOk;
    }

    /**
     * @param array $data
     * @return LMPResponseInterface
     */
    public function setData(array $data): LMPResponseInterface
    {
        $this->isOk = $data['response'] === 'ok';

        if (array_key_exists('data', $data) && is_array($data['data'])) {
            $this->payment = Hydrate::toObject(Payment::class, $data['data']);
        }

        return $this;
    }

    /**
     * @return Payment
     */
    public function getPayment(): Payment
    {
        return $this->payment;
    }
}
