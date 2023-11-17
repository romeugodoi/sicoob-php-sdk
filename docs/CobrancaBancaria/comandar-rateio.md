# Comandar rateio de crédito de boletos

Parâmetros:
- Array de objetos da classe Payload/ComandarRateioCredito

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new ComandarRateioCredito(
            2588658,
            [
                new RateioCredito(
                    1,
                    5191,
                    1,
                    true,
                    CodigoTipoValorRateio::PERCENTUAL,
                    65.00,
                    CodigoTipoCalculoRateio::VALOR_COBRADO,
                    '12345678901',
                    'Rharison Lucas Moreira Abreu',
                    CodigoFinalidadeTED::CREDITO_EM_CONTA,
                    CodigoTipoContaDestinoTED::CONTA_CORRENTE,
                    1,
                )
            ],
        )
    ];

    $response = $this->cobrancaBancaria->comandarRateioCreditoBoletos($data);
```

#### Retorno:

```json
[
    {
        "nossoNumero": 2588658,
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
        ]
    }
]
```

## Referência

- [Documentação Oficial - Comandar rateio de crédito de boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#de10cd80-76bc-4ccf-8d0a-d1f50a3351f1)