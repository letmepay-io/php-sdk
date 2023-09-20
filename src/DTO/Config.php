<?php

namespace LetmepayIo\Sdk\DTO;

class Config
{
    private string $authUrl;
    private string $baseUrl;
    private string $clientId;
    private string $clientSecret;

    public function __construct(string $authUrl, string $baseUrl, string $clientId, string $clientSecret)
    {
        $this->authUrl = $authUrl;
        $this->baseUrl = $baseUrl;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return string
     */
    public function getAuthUrl(): string
    {
        return $this->authUrl;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }
}