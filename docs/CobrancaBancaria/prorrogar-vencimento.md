# Prorrogar a data de vencimento de boletos

Parâmetros:
- Array de objetos da classe Payload/ProrrogarDataVencimento

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $payload = [
        new ProrrogarDataVencimento(
            2588658,
            (new DateTime('now'))->setTime(0,0)->format('Y-m-d\TH:i:sP')
        )
    ];

    $response = $this->cobrancaBancaria->prorrogarDataVencimentoBoletos($payload);
```

#### Retorno:

```json
[
    {
        "nossoNumero": 123,
        "dataVencimento": "2018-09-20T00:00:00-03:00"
    }
]
```

## Referência

- [Documentação Oficial - Prorrogar a data de vencimento de boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#3a37e9b9-ae04-4309-a135-542671cd506d)