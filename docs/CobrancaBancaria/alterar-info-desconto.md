# Alterar informações de valor de desconto e/ou data de desconto e/ou tipo de desconto de boletos

Parâmetros:
- Array de objetos da classe Payload/AlterarInformacoesDesconto

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new AlterarInformacoesDesconto(
            2588658,
            TipoDesconto::SEM_DESCONTO,
        )
    ];

    $response = $this->cobrancaBancaria->alterarInformacoesDescontoBoletos($data);
```

#### Retorno:

```json
[
    {
        "nossoNumero": 123,
        "tipoDesconto": 1,
        "dataPrimeiroDesconto": "2018-09-20T00:00:00-03:00",
        "valorPrimeiroDesconto": 1,
        "dataSegundoDesconto": "2018-09-20T00:00:00-03:00",
        "valorSegundoDesconto": 0,
        "dataTerceiroDesconto": "2018-09-20T00:00:00-03:00",
        "valorTerceiroDesconto": 0
    }
]
```

## Referência

- [Documentação Oficial - Alterar informações de valor de desconto e/ou data de desconto e/ou tipo de desconto de boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#e1a591a9-8935-4105-bad6-931bcc14a583)