<?php

namespace LetmepayIo\Sdk;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use LetmepayIo\Sdk\DTO\Charge;
use LetmepayIo\Sdk\DTO\ChargePixDetails;
use LetmepayIo\Sdk\DTO\Config;
use LetmepayIo\Sdk\DTO\Payment;
use LetmepayIo\Sdk\Exceptions\Error;
use LetmepayIo\Sdk\HttpResources\Requests\AuthenticationRequest;
use LetmepayIo\Sdk\HttpResources\Requests\CreateChargeRequest;
use LetmepayIo\Sdk\HttpResources\Requests\CreatePaymentRequest;
use LetmepayIo\Sdk\HttpResources\Requests\GetChargeRequest;
use LetmepayIo\Sdk\HttpResources\Requests\GetPixChargeDetailsRequest;
use LetmepayIo\Sdk\HttpResources\Requests\LMPRequestInterface;
use LetmepayIo\Sdk\HttpResources\Responses\AuthenticationResponse;
use LetmepayIo\Sdk\HttpResources\Responses\ErrorLMPResponse;
use LetmepayIo\Sdk\HttpResources\Responses\LMPResponseInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private string $accessToken = '';

    private GuzzleClient $client;

    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->client = new GuzzleClient();
    }

    public function setClient(GuzzleClient $client) : self
    {
        $this->client = $client;
        return $this;
    }

    public function setConfig(Config $config) : self
    {
        $this->config = $config;
        return $this;
    }

    private function handleErrorBody(ResponseInterface $response): LMPResponseInterface
    {
        try {
            $body = json_decode($response->getBody()->getContents(), true);
            return (new ErrorLMPResponse())->setData($body);
        } catch (Exception $e) {
            throw new Exception('Unexpected error, please contact support.');
        }
    }

    /**
     * @param LMPRequestInterface $request
     * @return LMPResponseInterface
     * @throws GuzzleException
     * @throws Exception
     */
    private function executeRequest(LMPRequestInterface $request): LMPResponseInterface
    {
        try {
            $headers = [
                'Content-Type' => 'application/json'
            ];
            $baseUrl = $this->config->getBaseUrl();

            if ($request->isAuth()) {
                $baseUrl = $this->config->getAuthUrl();
            } else {
                $headers['Authorization'] = sprintf('Bearer %s', $this->accessToken);
            }

            $url = $baseUrl . $request->path();
            $options = [
                'headers' => $headers,
            ];

            if (in_array($request->method(), ['POST', 'PUT', 'PATCH'])) {
                $options['json'] = $request->body();
            }

            $res = $this->client->request($request->method(), $url, $options);
            if ($res->getStatusCode() == 200 || $res->getStatusCode() == 201) {
                $data = json_decode($res->getBody()->getContents(), true);
                /**
                 * @var LMPResponseInterface $response
                 */
                $response = new ($request->responseClass())();
                $response->setData($data);

                return $response;
            }
        } catch (ClientException $e) {
            if ($e->hasResponse()) {
                return $this->handleErrorBody($e->getResponse());
            }
        }

        throw new Exception('Unexpected error, please contact support.');
    }

    /**
     * @throws Exception|GuzzleException
     */
    private function authenticate(): void
    {
        $request = (new AuthenticationRequest())
            ->setClientId($this->config->getClientId())
            ->setClientSecret($this->config->getClientSecret())
            ->setAudience($this->config->getBaseUrl());

        /**
         * @var AuthenticationResponse $response
         */
        $response = $this->executeRequest($request);
        if ($response->isOk()) {
            $this->accessToken = $response->getAccessToken();
            return;
        }

        $error = new Error('Invalid Credentials.', 403);
        $error->setErrors([
            'client_id' => $this->config->getClientId(),
        ]);
        throw $error;
    }

    /**
     * @param string $payerTaxId
     * @param float $amount
     * @param string $externalId
     * @param string $description
     * @param int $expiration
     * @param array $splits
     * @return Charge
     * @throws Error
     */
    public function createCharge(string $payerTaxId, float $amount, string $externalId, string $description, int $expiration = 0, array $splits = []): Charge
    {
        try {
            $this->authenticate();
            $request = (new CreateChargeRequest())
                ->setPayerTaxId($payerTaxId)
                ->setAmount($amount)
                ->setExternalId($externalId)
                ->setDescription($description)
                ->setExpiration($expiration)
                ->setSplits($splits);

            $response = $this->executeRequest($request);
            if ($response->isOk()) {
                return $response->getCharge();
            }

            throw new Exception($response->getMessage());
        } catch (GuzzleException $e) {
            $error = new Error($e->getMessage(), $e->getCode());
            $error->setErrors(['type' => 'unexpected']);
            throw $error;
        }
    }

    /**
     * @param string $id
     * @return Charge
     * @throws Error
     */
    public function getCharge(string $id): Charge
    {
        try {
            $this->authenticate();

            $request = (new GetChargeRequest())->setId($id);
            $response = $this->executeRequest($request);
            if ($response->isOk()) {
                return $response->getCharge();
            }

            throw new Exception($response->getMessage());
        } catch (GuzzleException $e) {
            $error = new Error($e->getMessage(), $e->getCode());
            $error->setErrors(['type' => 'unexpected']);
            throw $error;
        }
    }

    /**
     * @param string $id
     * @return ChargePixDetails
     * @throws Error
     */
    public function getQrCode(string $id): ChargePixDetails
    {
        try {
            $this->authenticate();

            $request = (new GetPixChargeDetailsRequest())->setId($id);
            $response = $this->executeRequest($request);
            if ($response->isOk()) {
                return $response->getChargePixDetails();
            }

            throw new Exception($response->getMessage());
        } catch (GuzzleException $e) {
            $error = new Error($e->getMessage(), $e->getCode());
            $error->setErrors(['type' => 'unexpected']);
            throw $error;
        }
    }

    /**
     * @param string $payerTaxId
     * @param string $keyType
     * @param string $key
     * @param int $amount
     * @param string $externalId
     * @param string $description
     * @return Payment
     * @throws Exception
     */
    public function createPayment(string $payerTaxId, string $keyType, string $key, int $amount, string $externalId, string $description): Payment
    {
        try {
            $this->authenticate();

            $request = (new CreatePaymentRequest())
                ->setType('pix')
                ->setPayerTaxId($payerTaxId)
                ->setKeyType($keyType)
                ->setKey($key)
                ->setAmount($amount)
                ->setExternalId($externalId)
                ->setDescription($description);
            $response = $this->executeRequest($request);
            if ($response->isOk()) {
                return $response->getPayment();
            }

            throw new Exception($response->getMessage());
        } catch (GuzzleException $e) {
            $error = new Error($e->getMessage(), $e->getCode());
            $error->setErrors(['type' => 'unexpected']);
            throw $error;
        }
    }
}
