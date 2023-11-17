# Alterar espécie de documento dos boletos

Parâmetros:
- Array de objetos da classe Payload/AlterarEspecieDocumento

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new AlterarEspecieDocumento(
            2588658,
            EspecieDocumento::FATURA,
        ),
    ];

    $response = $this->cobrancaBancaria->alterarEspecieDocumentoBoletos($data);
```

#### Retorno:

```json
[
    {
        "nossoNumero": 123,
        "especieDocumento": "DM"
    }
]
```

## Referência

- [Documentação Oficial - Alterar espécie de documento dos boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#f7a6b3e0-bd2a-40ef-9170-3547d8bad5da)