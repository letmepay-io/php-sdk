<?php

namespace LetmepayIo\Sdk;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use LetmepayIo\Sdk\DTO\Config;
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
    private string $baseUrl;

    private string $authUrl;
    private GuzzleClient $client;

    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->client = new GuzzleClient();
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

        throw new \Exception('Invalid Credentials.');
    }

    /**
     * @param string $payerTaxId
     * @param float $amount
     * @param string $externalId
     * @param string $description
     * @param int $expiration
     * @param array $splits
     * @return LMPResponseInterface
     * @throws Exception
     */
    public function createCharge(string $payerTaxId, float $amount, string $externalId, string $description, int $expiration = 0, array $splits = []): LMPResponseInterface
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

            return $this->executeRequest($request);
        } catch (GuzzleException $e) {
            //TODO: debug
        }
        throw new Exception('Unexpected error, please contact support.');
    }

    /**
     * @param string $id
     * @return LMPResponseInterface
     * @throws Exception
     */
    public function getCharge(string $id): LMPResponseInterface
    {
        try {
            $this->authenticate();

            $request = (new GetChargeRequest())->setId($id);
            return $this->executeRequest($request);
        } catch (GuzzleException $e) {
            //TODO: debug
        }
        throw new Exception('Unexpected error, please contact support.');
    }

    /**
     * @param string $id
     * @return LMPResponseInterface
     * @throws Exception
     */
    public function getQrCode(string $id): LMPResponseInterface
    {
        try {
            $this->authenticate();

            $request = (new GetPixChargeDetailsRequest())->setId($id);
            return $this->executeRequest($request);
        } catch (GuzzleException $e) {
            //TODO: debug
        }
        throw new Exception('Unexpected error, please contact support.');
    }

    /**
     * @param string $payerTaxId
     * @param string $keyType
     * @param string $key
     * @param int $amount
     * @param string $externalId
     * @param string $description
     * @return LMPResponseInterface
     * @throws Exception
     */
    public function createPayment(string $payerTaxId, string $keyType, string $key, int $amount, string $externalId, string $description): LMPResponseInterface
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
            return $this->executeRequest($request);
        } catch (GuzzleException $e) {
            //TODO: debug
        }
        throw new Exception('Unexpected error, please contact support.');
    }
}
