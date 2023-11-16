<?php

namespace Logics\SicoobSdk\Enum;

enum IdentificacaoEmissaoBoleto: int
{
    case BANCO_EMITE = 1;
    case CLIENTE_EMITE = 2;

    public static function get(int $code): IdentificacaoEmissaoBoleto
    {
        return match ($code) {
            1 => IdentificacaoEmissaoBoleto::BANCO_EMITE,
            2 => IdentificacaoEmissaoBoleto::CLIENTE_EMITE,
        };
    }
}