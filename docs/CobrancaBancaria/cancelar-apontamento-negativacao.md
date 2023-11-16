# Cancelar o Apontamento da Negativação de Pagadores

Parâmetros:
- Array de objetos da classe Payload/CancelarApontamentoNegativacao

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new CancelarApontamentoNegativacao(
            2588658
        )
    ];

    $response = $this->cobrancaBancaria->cancelarApontamentoNegativacaoPagadores($data);
```

## Referência

- [Documentação Oficial - Cancelar o Apontamento da Negativação de Pagadores](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#16305b4e-4490-49de-b47b-da40ba266e9a)