# Consultar a situação da solicitação da movimentação

Parametro:
- codigoSolicitacao

```php
    $response = $this->cobrancaBancaria->consultarSituacaoSolicitacaoMovimentacao(
        132,
    );
```

Retorno:

```json
    {
        "quantidadeTotalRegistros": "1.500.000",
        "quantidadeRegistrosArquivo": 500000,
        "quantidadeArquivo": 3,
        "idArquivos": [
            30025254,
            30025255,
            30025256
        ]
    }
```

## Referência

- [Documentação Oficial - Consulctar a situação da solicitação da movimentação](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#85985f79-8ee7-4ef8-9303-cda9dd0afffc)