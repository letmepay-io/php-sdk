<?php

namespace LetmepayIo\Sdk;

class VerifyWebhook
{
    /**
     * @param string $key
     * @param string $md5
     * @param string $signature
     * @return bool
     */
    public static function isValid(string $key, string $md5, string $signature) : bool
    {
        $calculated = hash_hmac('sha256', $md5, $key);
        return $signature == $calculated;
    }
}