<?php

namespace Logics\SicoobSdk\Enum;

enum CodigoTipoContaDestinoTED: string
{
    case CONTA_CORRENTE = 'CC';
    case CONTA_DEPOSITO = 'CD';
    case CONTA_GARANTIDA = 'CG';

    public static function get(string $code): CodigoTipoContaDestinoTED
    {
        return match ($code) {
            'CC' => CodigoTipoContaDestinoTED::CONTA_CORRENTE,
            'CD' => CodigoTipoContaDestinoTED::CONTA_DEPOSITO,
            'CG' => CodigoTipoContaDestinoTED::CONTA_GARANTIDA,
        };
    }
}