<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class CancelarApontamentoNegativacao extends BasePayloadCobrancaBancaria
{

    public function __construct(int $nossoNumero)
    {
        parent::__construct($nossoNumero);
    }

    public static function createFromJsonArray($data): CancelarApontamentoNegativacao
    {
        return new CancelarApontamentoNegativacao(
            $data->nossoNumero,
        );
    }
}