<?php

namespace Logics\SicoobSdk\Enum;

enum CodigoSituacao: string
{
    case EM_ABERTO = 'Em Aberto';
    case BAIXADO = 'Baixado';
    case LIQUIDADO = 'Liquidado';

    public static function get(string $code): CodigoSituacao
    {
        return match ($code) {
            'Em Aberto' => CodigoSituacao::EM_ABERTO,
            'Baixado' => CodigoSituacao::BAIXADO,
            'Liquidado' => CodigoSituacao::LIQUIDADO,
        };
    }
}
