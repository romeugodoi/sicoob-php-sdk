# Alterar o valor nominal de boletos de cartão de crédito

Parâmetros:
- Array de objetos da classe Payload/AlterarValorNominalBoletoCartaoCredito

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new AlterarValorNominalBoletoCartaoCredito(
            2588658,
            10.0,
        ),
    ];

    $response = $this->cobrancaBancaria->alterarValorNominalBoletosCartaoCredito($data);
```

#### Retorno:

```json
[
    {
        "nossoNumero": 123,
        "valor": 156.23
    }
]
```

## Referência

- [Documentação Oficial - Alterar o valor nominal de boletos de cartão de crédito](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#97aa592b-09a2-49cc-8641-c2dfe343c50c)