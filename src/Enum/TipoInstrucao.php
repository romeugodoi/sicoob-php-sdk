<?php

namespace Logics\SicoobSdk\Enum;

enum TipoInstrucao: int
{
    case OUTROS = 1;
    case CORPO_DE_INSTRUCOES_DA_FICHA_DE_COMPENSACAO_DO_BLOQUEIO = 3;

    public static function get(int $code): TipoInstrucao
    {
        return match ($code) {
            1 => TipoInstrucao::OUTROS,
            3 => TipoInstrucao::CORPO_DE_INSTRUCOES_DA_FICHA_DE_COMPENSACAO_DO_BLOQUEIO,
        };
    }
}
