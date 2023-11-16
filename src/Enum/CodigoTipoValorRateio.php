<?php

namespace Logics\SicoobSdk\Enum;

enum CodigoTipoValorRateio: int
{
    case PERCENTUAL = 1;

    public static function get(int $code): CodigoTipoValorRateio
    {
        return match ($code) {
            1 => CodigoTipoValorRateio::PERCENTUAL,
        };
    }
}
