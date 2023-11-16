# Baixar a Negativação de Pagadores

Parâmetros:
- Array de objetos da classe Payload/BaixarNegativacao

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new BaixarNegativacao(
            2588658,
        ),
    ];

    $response = $this->cobrancaBancaria->baixarNegativacaoPagadores($data);
```

## Referência

- [Documentação Oficial - Baixar a Negativação de Pagadores](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#df838452-535f-4dda-8d4c-254c12ee31fb)