<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class ProrrogarDataLimitePagamento extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero, string $dataLimitePagamento)
    {
        $this->dataLimitePagamento = $dataLimitePagamento;

        parent::__construct(
            $nossoNumero
        );
    }

    private string $dataLimitePagamento;

    public function getDataLimitePagamento(): string
    {
        return $this->dataLimitePagamento;
    }

    public static function createFromJsonArray($data): ProrrogarDataLimitePagamento
    {
        return new ProrrogarDataLimitePagamento(
            $data->nossoNumero,
            $data->dataLimitePagamento
        );
    }
}