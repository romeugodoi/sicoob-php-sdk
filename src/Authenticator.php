<?php
namespace Logics\SicoobSdk;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Logics\SicoobSdk\Config\Authentication;
use Logics\SicoobSdk\Config\SandboxData;
use Logics\SicoobSdk\Enum\GrantType;
use Logics\SicoobSdk\Enum\ScopesCobrancaBancaria;

class Authenticator
{
    /**
     * @throws Exception
     */
    public function __construct(
        private readonly string $clientId,
        private readonly string $certificate,
        private readonly string $certificateKey,
        private readonly ?bool $isSandbox = false,
    )
    {
        if(!$this->isSandbox) {
            $this->setToken($this->generateToken());
            $this->setScope(ScopesCobrancaBancaria::SCOPES_COBRANCA_BANCARIA);
            $this->setGrantType(GrantType::CLIENT_CREDENTIALS);
        }
    }

    private string $grantType;

    private string $scope;

    private string $token;

    private int $refreshTokenExpirationTime;

    /**
     * @throws Exception
     */
    public function getToken(): string
    {
        if($this->isSandbox) {
            return SandboxData::TOKEN;
        }

        if ($this->verifyIfTokenIsValid()) {
            return $this->token;
        }

        $this->setToken($this->generateToken());

        return $this->token;
    }

    private function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function setScope(string $scope): void
    {
        $this->scope = $scope;
    }

    public function getGrantType(): string
    {
        return $this->grantType;
    }

    public function setGrantType(string $grantType): void
    {
        $this->grantType = $grantType;
    }

    public function isSandbox(): bool
    {
        return $this->isSandbox;
    }

    public function setRefreshTokenExpirationTime(int $refreshTokenExpirationTime): void
    {
        $this->refreshTokenExpirationTime = $refreshTokenExpirationTime;
    }

    private function verifyIfTokenIsValid(): bool
    {
        return $this->refreshTokenExpirationTime > time();
    }

    /**
     * @throws Exception
     */
    private function generateToken(): string
    {
        try {
            $client = new Client([
                'base_uri' => Authentication::BASE_URI,
            ]);

            $options = [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'client_id' => $this->clientId,
                    'grant_type' => $this->grantType,
                    'scope' => $this->scope,
                    'cert' => $this->certificate, // '/path/to/openyes.crt.pem',
                    'ssl_key' => $this->certificateKey, // /path/to/openyes.key.pem'
                ],
            ];

            $response = $client->request(
                'POST',
                Authentication::API_URI,
                $options
            );

            $contentResponse = json_decode($response->getBody()->getContents());
            $this->setRefreshTokenExpirationTime($contentResponse->refresh_expires_in);
            return $contentResponse->access_token;
        } catch (GuzzleException $e) {
            echo $e->getMessage();

            throw new Exception("Erro ao gerar token de acesso: ", $e->getCode());
        }
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }
}