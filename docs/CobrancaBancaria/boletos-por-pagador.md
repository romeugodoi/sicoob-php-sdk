# Listar Boletos por Pagador

O método <i>listarBoletosPorPagador</i> necessita dos seguintes parâmetros:
- codigoSituacao - Um dos valores do enum CodigoSituacaoParam
- dataInicio 
- dataFim
- numeroCpfCnpj

Se a consulta for bem sucedida o retorno será um array de objetos da classe <i>Boleto</i>.

```php
    $response = $this->cobrancaBancaria->listarBoletosPorPagador(
        CodigoSituacaoParam::BAIXADO,
        (new DateTime('2021-01-01'))->setTime(0,0)->format('Y-m-d'),
        (new DateTime('2021-12-31'))->setTime(0,0)->format('Y-m-d'),
        '12345678910'
    );
```

#### Retorno:

```json
[
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
]
```

## Referência

- [Documentação Oficial - Listar Boletos por Pagador](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#f969814d-6332-4a7c-979d-316f50f36360)