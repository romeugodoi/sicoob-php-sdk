# Alterar boleto para utilização de PIX

Parâmetros:
- Array de objetos da classe Payload/AlterarParaUtilizarPIX

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new AlterarParaUtilizarPIX(
            2588658
        )
    ];

    $response = $this->cobrancaBancaria->alterarBoletoParaUtilizarPix($data);
```

## Referência

- [Documentação Oficial - Alterar boleto para utilização de PIX](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#7c234842-1c26-4351-b7b1-a27e0d96c279)