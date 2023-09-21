<?php

namespace LetmepayIo\Sdk\HttpResources\Responses;

class AuthenticationResponse implements LMPResponseInterface
{

    private bool $isOk = false;
    private string $accessToken = '';
    private string $scope = '';
    private int $expiresIn = 0;
    private string $tokenType = '';

    public function isOk(): bool
    {
        return $this->isOk;
    }

    public function setData(array $data): LMPResponseInterface
    {
        if (
            array_key_exists('access_token', $data) &&
            array_key_exists('scope', $data) &&
            array_key_exists('expires_in', $data) &&
            array_key_exists('token_type', $data) &&
            is_int($data['expires_in'])
        ) {
            $this->accessToken = $data['access_token'];
            $this->scope = $data['scope'];
            $this->expiresIn = $data['expires_in'];
            $this->tokenType = $data['token_type'];
            $this->isOk = true;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }
}
