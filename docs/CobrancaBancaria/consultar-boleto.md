# Consultar Boleto

O método <i>consultarBoleto</i> consegue buscar boletos utilizando 1 dos 3 parâmetros abaixo:
 - linhaDigital
 - codigoBarras
 - nossoNumero

Ao menos um dos parâmetros deve ser informado, caso mais de um seja informado, será priorizar a busca pelo parâmetro linhaDigital, depois codigoBarras e por último nossoNumero. Se a consultar for bem sucedida o retorno do método será uma instância da classe Boleto.

```php
    $boleto = $this->cobrancaBancaria->consultarBoleto('34191090022001300000000000000000000000000000');
```

## Referência

- [Documentação Oficial - Consultar Boleto](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#cb15c3cb-dc4a-475e-8a60-cceb2bc3285d)