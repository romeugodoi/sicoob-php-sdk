<?php

namespace Logics\SicoobSdk\Enum;

enum CodigoTipoCalculoRateio: int
{
    case VALOR_COBRADO = 1;

    public static function get(int $code): CodigoTipoCalculoRateio
    {
        return match ($code) {
            1 => CodigoTipoCalculoRateio::VALOR_COBRADO,
        };
    }
}
