<?php

namespace Logics\SicoobSdk\Enum;

enum CodigoNegativacao: int
{
    case NEGATIVAR_DIAS_UTEIS = 2;
    case NAO_NEGATIVAR = 3;

    public static function get(int $code): CodigoNegativacao
    {
        return match ($code) {
            2 => CodigoNegativacao::NEGATIVAR_DIAS_UTEIS,
            3 => CodigoNegativacao::NAO_NEGATIVAR,
        };
    }
}
