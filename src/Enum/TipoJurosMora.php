<?php

namespace Logics\SicoobSdk\Enum;

enum TipoJurosMora: int
{
    case VALOR_FIXO = 1;
    case TAXA_MENSAL = 2;
    case ISENTO = 3;

    public static function get(int $code): TipoJurosMora
    {
        return match ($code) {
            1 => TipoJurosMora::VALOR_FIXO,
            2 => TipoJurosMora::TAXA_MENSAL,
            3 => TipoJurosMora::ISENTO,
        };
    }
}