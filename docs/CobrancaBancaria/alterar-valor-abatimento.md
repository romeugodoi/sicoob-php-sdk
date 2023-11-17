# Alterar o valor de abatimento de boletos

Parâmetros:
- Array de objetos da classe Payload/AlterarValorAbatimento

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new AlterarValorAbatimento(
            2588658,
            10.0,
        ),
    ];

    $response = $this->cobrancaBancaria->alterarValorAbatimentoBoletos($data);
```
#### Retorno:

```json
[
    {
        "nossoNumero": 123,
        "valorAbatimento": 1
    }
]
```

## Referência

- [Documentação Oficial - Alterar o valor de abatimento de boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#2aeb68fb-11f0-4ee9-941f-91ae00fb7743)