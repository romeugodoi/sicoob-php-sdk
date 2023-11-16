<?php

namespace Logics\SicoobSdk\Enum;

enum IdentificacaoDistribuicaoBoleto: int
{
    case BANCO_DISTRIBUI = 1;
    case CLIENTE_DISTRIBUI = 2;

    public static function get(int $code): IdentificacaoDistribuicaoBoleto
    {
        return match ($code) {
            1 => IdentificacaoDistribuicaoBoleto::BANCO_DISTRIBUI,
            2 => IdentificacaoDistribuicaoBoleto::CLIENTE_DISTRIBUI,
        };
    }
}
