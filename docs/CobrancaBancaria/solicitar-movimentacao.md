# Solicitar a movimentação da carteira de cobrança registrada para beneficiário informado

Parâmetros:
- tipoMovimentacao - Um dos valores do Enum TipoMovimentacao
- dataInicial
- dataFinal

```php
    $response = $this->cobrancaBancaria->solicitarMovimentacaoCarteiraBeneficiario(
        TipoMovimentacao::BAIXA,
        "2018-09-20T00:00:00-03:00",
        "2018-09-20T00:00:00-03:00",
    );
```

Retorno:

```json
    {
        "mensagem": "Solicitação recebida com sucesso. Utilize o 'Código da Solicitação' para verificar se já foi processada.",
        "codigoSolicitacao": 132
    }
```

## Referência

- [Documentação Oficial - Solicitar a movimentação da carteira de cobrança registrada para beneficiário informado](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#1b0da494-04c4-4053-9d87-0b4f4586287d)