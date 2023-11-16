# Listar Boletos por Pagador

O método <i>listarBoletosPorPagador</i> necessita dos seguintes parâmetros:
- codigoSituacao - Um dos valores do enum CodigoSituacaoParam
- dataInicio 
- dataFim
- numeroCpfCnpj

Se a consulta for bem sucedida o retorno será um array de objetos da classe <i>Boleto</i>.

```php
    $response = $this->cobrancaBancaria->listarBoletosPorPagador(
        CodigoSituacaoParam::BAIXADO,
        (new DateTime('2021-01-01'))->setTime(0,0)->format('Y-m-d'),
        (new DateTime('2021-12-31'))->setTime(0,0)->format('Y-m-d'),
        '12345678910'
    );
```

## Referência

- [Documentação Oficial - Listar Boletos por Pagador](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#f969814d-6332-4a7c-979d-316f50f36360)