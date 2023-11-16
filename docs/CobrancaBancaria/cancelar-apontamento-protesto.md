# Cancelar o apontamento de protesto de boletos

Parâmetros:
- Array de objetos da classe Payload/CancelarApontamentoProtesto

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new CancelarApontamentoProtesto(
            2588658
        )
    ];

    $response = $this->cobrancaBancaria->cancelarApontamentoProtestoBoletos($data);
```


## Referência

- [Documentação Oficial - Cancelar o apontamento de protesto de boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#cd36bd47-152d-47a6-b8a2-3f8fc6ea68a3)