<?php

namespace Logics\SicoobSdk\Enum;

enum CodigoProtesto: int
{
    case PROTESTAR_DIAS_CORRIDOS = 1;
    case PROTESTAR_DIAS_UTEIS = 2;
    case NAO_PROTESTAR = 3;

    public static function get(int $code): CodigoProtesto
    {
        return match ($code) {
            1 => CodigoProtesto::PROTESTAR_DIAS_CORRIDOS,
            2 => CodigoProtesto::PROTESTAR_DIAS_UTEIS,
            3 => CodigoProtesto::NAO_PROTESTAR,
        };
    }
}