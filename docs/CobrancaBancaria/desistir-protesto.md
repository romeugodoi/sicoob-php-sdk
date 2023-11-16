# Desistir do Protesto de Boletos

Parâmetros:
- Array de objetos da classe Payload/DesistirProtesto

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new DesistirProtesto(
            2588658
        )
    ];

    $response = $this->cobrancaBancaria->desistitProtestoBoletos($data);
```

## Referência

- [Documentação Oficial - Desistir do Protesto de Boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#b27936c3-b7e0-446a-b5f7-d167ba240eca)