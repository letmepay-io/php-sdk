<?php

namespace LetmepayIo\Tests\Fixtures;

class ChargesFixture
{
    public static function success(): string
    {
        return '{"response":"ok","data":{"id":"71e79bb7-9341-4da0-8536-61f11b27c658","type":"pix","payer_tax_id":"05852983942","amount":"100","external_id":"D9KRwMExmp4poU1","expiration":0,"payment_url":"https://api.sandbox.letmepay.io/v1/charges/71e79bb7-9341-4da0-8536-61f11b27c658/image","description":"teste do kauan","status":"initial","split":[{"id":"9078b4c9-7052-4ee1-872e-fc229324b870","key":"00000000191","key_type":"cpf","percentage":"85","amount":"85","external_id":"D9KRwMExmp4poU1-MjgoLPduRK","payer_tax_id":"05852983942","charge_id":"71e79bb7-9341-4da0-8536-61f11b27c658","created_at":"2023-09-21T13:52:27.658328Z","updated_at":"2023-09-21T13:52:27.658328Z"}],"created_at":"2023-09-21T13:52:27.573205Z","updated_at":"2023-09-21T13:52:27.573205Z"}}';
    }

    public static function error() : string
    {
        return '{"status":"error","message":"validation error","errors":{"type":"must be a valid value"},"debug_trace_id":"localhost/h0WVtzZyAF-000074"}';
    }
}