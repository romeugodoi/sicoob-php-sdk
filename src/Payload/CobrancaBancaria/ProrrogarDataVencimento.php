<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class ProrrogarDataVencimento extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero, string $dataVencimento)
    {
        $this->dataVencimento = $dataVencimento;

        parent::__construct(
            $nossoNumero
        );
    }

    private string $dataVencimento;

    public function getDataVencimento(): string
    {
        return $this->dataVencimento;
    }

    public static function createFromJsonArray($data): ProrrogarDataVencimento
    {
        return new ProrrogarDataVencimento(
            $data->nossoNumero,
            $data->dataVencimento
        );
    }
}