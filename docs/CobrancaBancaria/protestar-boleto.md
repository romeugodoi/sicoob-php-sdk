# Protestar Boletos

Parâmetros:
- Array de objetos da classe Payload/ProtestarBoleto

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $data = [
        new ProtestarBoleto(
            2588658
        )
    ];
    
    $response = $this->cobrancaBancaria->protestarBoletos($data);
```

## Referência

- [Documentação Oficial - Protestar Boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#bd4bef2d-ab63-41ed-acaf-7d5d0400b4af)