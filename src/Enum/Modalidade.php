<?php

namespace Logics\SicoobSdk\Enum;

enum Modalidade: int
{
    case SIMPLES_COM_REGISTRO = 1;

    public static function get(int $code): Modalidade
    {
        return match ($code) {
            1 => Modalidade::SIMPLES_COM_REGISTRO,
        };
    }

}