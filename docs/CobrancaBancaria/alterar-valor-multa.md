# Alterar valor de multa de boletos

Parâmetros:
- Array de objetos da classe Payload/AlterarValorMulta

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new AlterarValorMulta(
            2588658,
            TipoMulta::VALOR_FIXO,
            "2018-09-20T00:00:00-03:00",
            5
        ),
    ];

    $response = $this->cobrancaBancaria->alterarValorMultaBoletos($data);
```

## Referência

- [Documentação Oficial - Alterar valor de multa de boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#ca8c2a45-6c68-474d-b3ad-3e2b46b38657)