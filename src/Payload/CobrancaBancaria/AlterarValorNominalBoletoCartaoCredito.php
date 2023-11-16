<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class AlterarValorNominalBoletoCartaoCredito extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero, float $valor)
    {
        $this->valor = $valor;

        parent::__construct(
            $nossoNumero
        );
    }

    private float $valor;

    public function getValor(): float
    {
        return $this->valor;
    }

    public static function createFromJsonArray($data): AlterarValorNominalBoletoCartaoCredito
    {
        return new AlterarValorNominalBoletoCartaoCredito(
            $data->nossoNumero,
            $data->valor
        );
    }
}