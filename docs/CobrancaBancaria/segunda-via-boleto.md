# Emitir Segunda via de um boleto

Como primeiro argumento do método <i>emitirSegundaViaBoleto</i> está o <b>gerarPdf</b> que indica se é para gerar o PDF do boleto ou não. O segundo argumento é o <b>codigoBarras</b> ou <b>linhaDigital</b> ou <b>nossoNumero</b> do boleto que deseja consultar.

Ao menos um dos parâmetros de identificação deve ser informado, caso mais de um seja informado, será priorizar a busca pelo parâmetro linhaDigital, depois codigoBarras e por último nossoNumero. Se a consultar for bem sucedida o retorno do método será uma instância da classe Boleto.


```php
    $boleto = $this->cobrancaBancaria->emitirSegundaViaBoleto(false, '34191090022001300000000000000000000000000000');
```

## Referência

- [Documentação Oficial - Emitir Segunda via de um boleto](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#f1bed281-b919-4535-99ed-9d3e08283b70)