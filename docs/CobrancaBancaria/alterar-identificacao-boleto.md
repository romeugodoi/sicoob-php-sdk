# Alterar seu número e/ou número de controle da empresa dos boletos

Parâmetros:
- Array de objetos da classe Payload/AlterarSeuNumeroIdBoletoEmpresa

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new AlterarSeuNumeroIdBoletoEmpresa(
            2588658,
            '123456',
        )
    ];

    $response = $this->cobrancaBancaria->alterarSeuNumeroOuIdBoletoEmpresaBoletos($data);
```

#### Retorno:

```json
[
    {
        "nossoNumero": 123,
        "seuNumero": "1235512",
        "identificacaoBoletoEmpresa": "209"
    }
]
```

## Referência

- [Documentação Oficial - Alterar seu número e/ou número de controle da empresa dos boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#8191a547-8fc8-4fb3-8008-daa374fcd4e7)