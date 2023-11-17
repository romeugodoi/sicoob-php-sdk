# Alterar valor de juros de mora de boletos

Parâmetros:
- Array de objetos da classe Payload/AlterarValorJurosMora

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new AlterarValorJurosMora(
            2588658,
            TipoJurosMora::VALOR_FIXO,
            "2018-09-20T00:00:00-03:00",
            5
        ),
    ];

    $response = $this->cobrancaBancaria->alterarValorJurosMoraBoletos($data);
```

#### Retorno:

```json
[
    {
        "nossoNumero": 123,
        "tipoJurosMora": 1,
        "dataJurosMora": "2018-09-20T00:00:00-03:00",
        "valorJurosMora": 4
    }
]
```

## Referência

- [Documentação Oficial - Alterar valor de juros de mora de boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#41096d19-d601-4df9-8ec2-8a4c72138b76)