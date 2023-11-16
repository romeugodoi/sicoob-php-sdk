<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class CancelarApontamentoProtesto extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero)
    {
        parent::__construct($nossoNumero);
    }

    public static function createFromJsonArray($data): CancelarApontamentoProtesto
    {
        return new CancelarApontamentoProtesto(
            $data->nossoNumero,
        );
    }
}