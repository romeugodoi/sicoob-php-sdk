<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class ComandarBaixa extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero, string $seuNumero)
    {
        $this->seuNumero = $seuNumero;

        parent::__construct($nossoNumero);
    }

    private string $seuNumero;

    public function getSeuNumero(): string
    {
        return $this->seuNumero;
    }

    public static function createFromJsonArray($data): ComandarBaixa
    {
        return new ComandarBaixa(
            $data->nossoNumero,
            $data->seuNumero
        );
    }
}