<?php

namespace Logics\SicoobSdk\Enum;

enum TipoDesconto: int
{
    case SEM_DESCONTO = 0;
    case VALOR_FIXO_ATE_A_DATA_INFORMADA = 1;
    case PERCENTUAL_ATE_A_DATA_INFORMADA = 2;
    case VALOR_POR_ANTICIPACAO_DIA_CORRIDO = 3;
    case VALOR_POR_ANTICIPACAO_DIA_UTIL = 4;
    case PERCENTUAL_POR_ANTICIPACAO_DIA_CORRIDO = 5;
    case PERCENTUAL_POR_ANTICIPACAO_DIA_UTIL = 6;

    public static function get(int $code): TipoDesconto
    {
        return match ($code) {
            1 => TipoDesconto::VALOR_FIXO_ATE_A_DATA_INFORMADA,
            2 => TipoDesconto::PERCENTUAL_ATE_A_DATA_INFORMADA,
            3 => TipoDesconto::VALOR_POR_ANTICIPACAO_DIA_CORRIDO,
            4 => TipoDesconto::VALOR_POR_ANTICIPACAO_DIA_UTIL,
            5 => TipoDesconto::PERCENTUAL_POR_ANTICIPACAO_DIA_CORRIDO,
            6 => TipoDesconto::PERCENTUAL_POR_ANTICIPACAO_DIA_UTIL,
            default => TipoDesconto::SEM_DESCONTO,
        };
    }
}