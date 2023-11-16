# Prorrogar a data limite para pagamento de boletos

Parâmetros:
- Array de objetos da classe Payload/ProrrogarDataLimitePagamento

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new ProrrogarDataLimitePagamento(
            2588658,
            (new DateTime('now'))->setTime(0,0)->format('Y-m-d\TH:i:sP')
        )
    ];

    $response = $this->cobrancaBancaria->prorrogarDataLimitePagamentoBoletos($data);
```


## Referência

- [Documentação Oficial - Prorrogar a data limite para pagamento de boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#81c9fe1b-8c44-4a17-a228-53d91b5064c2)