<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero)
    {
        $this->nossoNumero = $nossoNumero;
    }

    private int $nossoNumero;

    public function getNossoNumero(): int
    {
        return $this->nossoNumero;
    }
}