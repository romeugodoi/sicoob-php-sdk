# Consultar Boleto

O método <i>consultarBoleto</i> consegue buscar boletos utilizando 1 dos 3 parâmetros abaixo:
 - linhaDigital
 - codigoBarras
 - nossoNumero

Ao menos um dos parâmetros deve ser informado, caso mais de um seja informado, será priorizar a busca pelo parâmetro linhaDigital, depois codigoBarras e por último nossoNumero. Se a consultar for bem sucedida o retorno do método será uma instância da classe Boleto.

```php
    $boleto = $this->cobrancaBancaria->consultarBoleto('34191090022001300000000000000000000000000000');
```

#### Retorno:

```json
{
    "numeroContrato": 25546454,
    "modalidade": 1,
    "numeroContaCorrente": 0,
    "especieDocumento": "DM",
    "dataEmissao": "2018-09-20T00:00:00-03:00",
    "nossoNumero": 0,
    "seuNumero": "1235512",
    "identificacaoBoletoEmpresa": "4562",
    "codigoBarras": "",
    "linhaDigitavel": "",
    "identificacaoEmissaoBoleto": 1,
    "identificacaoDistribuicaoBoleto": 1,
    "valor": 156.23,
    "dataVencimento": "2018-09-20T00:00:00-03:00",
    "dataLimitePagamento": "2018-09-20T00:00:00-03:00",
    "valorAbatimento": 1,
    "tipoDesconto": 1,
    "dataPrimeiroDesconto": "2018-09-20T00:00:00-03:00",
    "valorPrimeiroDesconto": 1,
    "dataSegundoDesconto": "2018-09-20T00:00:00-03:00",
    "valorSegundoDesconto": 0,
    "dataTerceiroDesconto": "2018-09-20T00:00:00-03:00",
    "valorTerceiroDesconto": 0,
    "tipoMulta": 1,
    "dataMulta": "2018-09-20T00:00:00-03:00",
    "valorMulta": 5,
    "tipoJurosMora": 1,
    "dataJurosMora": "2018-09-20T00:00:00-03:00",
    "valorJurosMora": 4,
    "numeroParcela": 1,
    "aceite": true,
    "codigoNegativacao": 2,
    "numeroDiasNegativacao": 60,
    "codigoProtesto": 1,
    "numeroDiasProtesto": 30,
    "quantidadeDiasFloat": 2,
    "pagador": {
      "numeroCpfCnpj": "98765432185",
      "nome": "Marcelo dos Santos",
      "endereco": "Rua 87 Quadra 1 Lote 1 casa 1",
      "bairro": "Santa Rosa",
      "cidade": "Luziânia",
      "cep": "72320000",
      "uf": "DF",
      "email": [
        "pagador@dominio.com.br"
      ]
    },
    "beneficiarioFinal": {
      "numeroCpfCnpj": "98784978699",
      "nome": "Lucas de Lima"
    },
    "mensagensInstrucao": {
      "tipoInstrucao": 1,
      "mensagens": [
        "Descrição da Instrução 1",
        "Descrição da Instrução 2",
        "Descrição da Instrução 3",
        "Descrição da Instrução 4",
        "Descrição da Instrução 5"
      ]
    },
    "rateioCreditos": [
      {
        "numeroBanco": 756,
        "numeroAgencia": 4027,
        "numeroContaCorrente": 0,
        "contaPrincipal": true,
        "codigoTipoValorRateio": 1,
        "valorRateio": 156.23,
        "codigoTipoCalculoRateio": 1,
        "numeroCpfCnpjTitular": "98765432185",
        "nomeTitular": "Marcelo dos Santos",
        "codigoFinalidadeTed": 10,
        "codigoTipoContaDestinoTed": "CC",
        "quantidadeDiasFloat": 1,
        "dataFloatCredito": "2020-12-30"
      }
    ],
    "pdfBoleto": "JVBERi0xLjQKJeLjz9MKMyAwIG9iago8PC9UeXBlL1hPYmplY3QvU3VidHlwZS9JbWFnZS9XaWR0aCA1Nzgv+PgolaVRleHQtNS41LjExCnN0YXJ0eHJlZgoyNzAxOQolJUVPRgo=",
    "qrCode": "00020101021226950014br.gov.bcb.pix2573pix.sicoob.com.br/qr/payload/v2/cobv/e736df1b-1389-4b96-a070-c8dddac768de5204000053039865802BR5924JULIO PEREIRA DE OLIVEIRA6008Brasilia62070503***630435A3"
}
```

## Referência

- [Documentação Oficial - Consultar Boleto](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#cb15c3cb-dc4a-475e-8a60-cceb2bc3285d)