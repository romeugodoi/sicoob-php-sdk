<?php

namespace Logics\SicoobSdk;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Logics\SicoobSdk\Config\ProductionData;
use Logics\SicoobSdk\Config\SandboxData;
use Psr\Http\Message\ResponseInterface;

class ClientRequest
{
    private Client $client;

    public function __construct(private readonly Authenticator $authenticator)
    {
        $baseUri = $this->authenticator->isSandbox()
            ? SandboxData::BASE_URI
            : ProductionData::BASE_URI;

        $this->client = new Client([ 'base_uri' => $baseUri ]);
    }

    /**
     * @throws Exception
     */
    public function request(string $method, string $uri, ?array $body = null): ResponseInterface
    {
        try {
            $token = $this->authenticator->getToken();
            $clientId = $this->authenticator->getClientId();
            $apiUri = $this->authenticator->isSandbox()
                ? SandboxData::API_URI
                : ProductionData::API_URI;

            $options = [
                  'headers' => [
                      'Content-Type' => 'application/json',
                      'Authorization' => "Bearer {$token}",
                      'Accept' => 'application/json',
                      'client_id' => $clientId
                  ]
            ];

            if($body) $options['body'] = json_encode($body);;

            return $this->client->request(
                $method,
                "{$apiUri}{$uri}",
                $options);
        } catch (GuzzleException $e) {
            echo $e->getMessage();

            throw new Exception("Erro ao fazer requisição: ", $e->getCode());
        }
    }
}