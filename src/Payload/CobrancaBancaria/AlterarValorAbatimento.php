<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class AlterarValorAbatimento extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero, string $valorAbatimento)
    {
        $this->valorAbatimento = $valorAbatimento;

        parent::__construct(
            $nossoNumero
        );
    }

    private float $valorAbatimento;

    public function getValorAbatimento(): float
    {
        return $this->valorAbatimento;
    }

    public static function createFromJsonArray($data): AlterarValorAbatimento
    {
        return new AlterarValorAbatimento(
            $data->nossoNumero,
            $data->valorAbatimento
        );
    }
}