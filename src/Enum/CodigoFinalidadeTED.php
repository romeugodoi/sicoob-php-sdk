<?php

namespace Logics\SicoobSdk\Enum;

enum CodigoFinalidadeTED: int
{
    case PAGAMENTO_IMPOSTOS_TRIBUTOS_TAXAS = 1;
    case PAGAMENTO_CONCESSIONARIAS_SERVICO_PUBLICO = 2;
    case PAGAMENTO_DIVIDENDOS = 3;
    case PAGAMENTO_SALARIOS = 4;
    case PAGAMENTO_FORNECEDORES = 5;
    case PAGAMENTO_HONORARIOS = 6;
    case PAGAMENTO_ALUGUEIS_TAXAS_CONDOMINIO = 7;
    case PAGAMENTO_DUPLICATAS_TITULOS = 8;
    case PAGAMENTO_MENSALIDADE_ESCOLAR = 9;
    case CREDITO_EM_CONTA = 10;
    case OUTROS = 99999;

    public static function get(int $code): CodigoFinalidadeTED
    {
        return match ($code) {
            1 => CodigoFinalidadeTED::PAGAMENTO_IMPOSTOS_TRIBUTOS_TAXAS,
            2 => CodigoFinalidadeTED::PAGAMENTO_CONCESSIONARIAS_SERVICO_PUBLICO,
            3 => CodigoFinalidadeTED::PAGAMENTO_DIVIDENDOS,
            4 => CodigoFinalidadeTED::PAGAMENTO_SALARIOS,
            5 => CodigoFinalidadeTED::PAGAMENTO_FORNECEDORES,
            6 => CodigoFinalidadeTED::PAGAMENTO_HONORARIOS,
            7 => CodigoFinalidadeTED::PAGAMENTO_ALUGUEIS_TAXAS_CONDOMINIO,
            8 => CodigoFinalidadeTED::PAGAMENTO_DUPLICATAS_TITULOS,
            9 => CodigoFinalidadeTED::PAGAMENTO_MENSALIDADE_ESCOLAR,
            10 => CodigoFinalidadeTED::CREDITO_EM_CONTA,
            99999 => CodigoFinalidadeTED::OUTROS,
        };
    }
}