<?php

namespace LetmepayIo\Sdk\HttpClient\Responses;

class AuthenticationResponse implements LMPResponseInterface
{

    private string $accessToken = '';
    private string $scope = '';
    private int $expiresIn = 0;
    private string $tokenType = '';

    public function isOk(): bool
    {
        return true;
    }

    public function setData(array $data): LMPResponseInterface
    {
        $this->accessToken = $data['access_token'];
        $this->scope = $data['scope'];
        $this->expiresIn = $data['expires_in'];
        $this->tokenType = $data['token_type'];

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
