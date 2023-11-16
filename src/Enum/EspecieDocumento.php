<?php

namespace Logics\SicoobSdk\Enum;

enum EspecieDocumento: string
{
    case CHEQUE = 'CH';
    case DUPLICATA_MERCANTIL = 'DM';
    case DUPLICATA_MERCANTIL_INDICACAO = 'DMI';
    case DUPLICATA_DE_SERVICO = 'DS';
    case DUPLICATA_DE_SERVICO_INDICACAO = 'DSI';
    case DUPLICATA_RURAL = 'DR';
    case LETRA_DE_CAMBIO = 'LC';
    case NOTA_DE_CREDITO_COMERCIAL = 'NCC';
    case NOTA_DE_CREDITO_EXPORTACAO = 'NCE';
    case NOTA_DE_CREDITO_INDUSTRIAL = 'NCI';
    case NOTA_DE_CREDITO_RURAL = 'NCR';
    case NOTA_PROMISSORIA = 'NP';
    case NOTA_PROMISSORIA_RURAL = 'NPR';
    case TRIPLICATA_MERCANTIL = 'TM';
    case TRIPLICATA_DE_SERVICO = 'TS';
    case NOTA_DE_SEGURO = 'NS';
    case RECIBO = 'RC';
    case FATURA = 'FAT';
    case NOTA_DE_DEBITO = 'ND';
    case APOLICE_DE_SEGURO = 'AP';
    case MENSALIDADE_ESCOLAR = 'ME';
    case PAGAMENTO_DE_CONSORCIO = 'PC';
    case NOTA_FISCAL = 'NF';
    case DOCUMENTO_DE_DIVIDA = 'DD';
    case CARTAO_DE_CREDITO = 'CC';
    case BOLETO_PROPOSTA = 'BDP';
    case OUTROS = 'OU';

    public static function get(string $code): EspecieDocumento
    {
        return match ($code) {
            'CH' => EspecieDocumento::CHEQUE,
            'DM' => EspecieDocumento::DUPLICATA_MERCANTIL,
            'DMI' => EspecieDocumento::DUPLICATA_MERCANTIL_INDICACAO,
            'DS' => EspecieDocumento::DUPLICATA_DE_SERVICO,
            'DSI' => EspecieDocumento::DUPLICATA_DE_SERVICO_INDICACAO,
            'DR' => EspecieDocumento::DUPLICATA_RURAL,
            'LC' => EspecieDocumento::LETRA_DE_CAMBIO,
            'NCC' => EspecieDocumento::NOTA_DE_CREDITO_COMERCIAL,
            'NCE' => EspecieDocumento::NOTA_DE_CREDITO_EXPORTACAO,
            'NCI' => EspecieDocumento::NOTA_DE_CREDITO_INDUSTRIAL,
            'NCR' => EspecieDocumento::NOTA_DE_CREDITO_RURAL,
            'NP' => EspecieDocumento::NOTA_PROMISSORIA,
            'NPR' => EspecieDocumento::NOTA_PROMISSORIA_RURAL,
            'TM' => EspecieDocumento::TRIPLICATA_MERCANTIL,
            'TS' => EspecieDocumento::TRIPLICATA_DE_SERVICO,
            'NS' => EspecieDocumento::NOTA_DE_SEGURO,
            'RC' => EspecieDocumento::RECIBO,
            'FAT' => EspecieDocumento::FATURA,
            'ND' => EspecieDocumento::NOTA_DE_DEBITO,
            'AP' => EspecieDocumento::APOLICE_DE_SEGURO,
            'ME' => EspecieDocumento::MENSALIDADE_ESCOLAR,
            'PC' => EspecieDocumento::PAGAMENTO_DE_CONSORCIO,
            'NF' => EspecieDocumento::NOTA_FISCAL,
            'DD' => EspecieDocumento::DOCUMENTO_DE_DIVIDA,
            'CC' => EspecieDocumento::CARTAO_DE_CREDITO,
            'BDP' => EspecieDocumento::BOLETO_PROPOSTA,
            'OU' => EspecieDocumento::OUTROS,
        };
    }
}