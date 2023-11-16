<?php

namespace Logics\SicoobSdk\Enum;

enum TipoMovimentacao: int
{
    case ENTRADA = 1;
    case PRORROGACAO = 2;
    case A_VENCER = 3;
    case VENCIDO = 4;
    case LIQUIDACAO = 5;
    case BAIXA = 6;

    public static function get(int $code): TipoMovimentacao
    {
        return match ($code) {
            1 => TipoMovimentacao::ENTRADA,
            2 => TipoMovimentacao::PRORROGACAO,
            3 => TipoMovimentacao::A_VENCER,
            4 => TipoMovimentacao::VENCIDO,
            5 => TipoMovimentacao::LIQUIDACAO,
            6 => TipoMovimentacao::BAIXA,
        };
    }
}
