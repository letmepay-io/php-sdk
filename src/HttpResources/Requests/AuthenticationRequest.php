<?php

namespace LetmepayIo\Sdk\HttpResources\Requests;

use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Responses\AuthenticationResponse;

class AuthenticationRequest implements LMPRequestInterface
{
    private ?string $audience = null;
    private ?string $clientId = null;
    private ?string $clientSecret = null;

    /**
     * @param string $audience
     * @return AuthenticationRequest
     */
    public function setAudience(string $audience): AuthenticationRequest
    {
        $this->audience = $audience;
        return $this;
    }

    /**
     * @param string $clientId
     * @return AuthenticationRequest
     */
    public function setClientId(string $clientId): AuthenticationRequest
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @param string $clientSecret
     * @return AuthenticationRequest
     */
    public function setClientSecret(string $clientSecret): AuthenticationRequest
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    public function path(): string
    {
        return '/oauth/token';
    }

    public function method(): string
    {
        return 'POST';
    }

    public function responseClass(): string
    {
        return AuthenticationResponse::class;
    }

    public function isAuth(): bool
    {
        return true;
    }

    /**
     * @return array|null
     * @throws Error
     */
    public function body(): ?array
    {
        if (
            !is_null($this->clientId) &&
            !is_null($this->clientSecret) &&
            !is_null($this->audience)
        ) {
            return [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'audience' => $this->audience,
                'grant_type' => 'client_credentials'
            ];
        }

        throw new Error('The params client_id, client_secret and audience are required.');
    }
}
