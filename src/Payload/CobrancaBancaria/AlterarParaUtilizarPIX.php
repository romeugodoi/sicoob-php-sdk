<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class AlterarParaUtilizarPIX extends BasePayloadCobrancaBancaria
{

    public function __construct(int $nossoNumero)
    {
        parent::__construct($nossoNumero);
    }

    public static function createFromJsonArray($data): AlterarParaUtilizarPIX
    {
        return new AlterarParaUtilizarPIX(
            $data->nossoNumero,
        );
    }
}