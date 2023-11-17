# Comandar a baixa de boletos

Parâmetros:
- Array de objetos da classe Payload/ComandarBaixa

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new ComandarBaixa(
            2588658,
            '123456',
        ),
    ];

    $response = $this->cobrancaBancaria->comandarBaixaBoletos($data);
```
#### Retorno:

```json
[
    {
        "seuNumero": "1235512",
        "nossoNumero": 123
    }
]
```

## Referência

- [Documentação Oficial - Comandar a baixa de boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#f9d41dd1-178f-47b2-ada8-453620377bca)