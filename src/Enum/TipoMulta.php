<?php

namespace Logics\SicoobSdk\Enum;

enum TipoMulta: int
{
    case ISENTO = 0;
    case VALOR_FIXO = 1;
    case PERCENTUAL = 2;

    public static function get(int $code): TipoMulta
    {
        return match ($code) {
            0 => TipoMulta::ISENTO,
            1 => TipoMulta::VALOR_FIXO,
            2 => TipoMulta::PERCENTUAL,
        };
    }
}