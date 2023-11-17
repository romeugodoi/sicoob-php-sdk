# Negativar Pagadores

Parâmetros:
- Array de objetos da classe Payload/NegativarPagadores

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new NegativarPagadores(
            2588658
        )
    ];

    $response = $this->cobrancaBancaria->negativarPagadores($data);
```

#### Retorno:

```json
[
    {
        "nossoNumero": 123
    }
]
```

## Referência

- [Documentação Oficial - Negativar Pagadores](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#175f0332-4aab-4063-9ab9-2abd2ce0fe43)