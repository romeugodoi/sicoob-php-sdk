# Incluir Boleto

Para a inclusão de um novo boleto deve-se utilizar o método <i>incluirBoleto</i> da classe [CobrancaBancaria](https://github.com/romeugodoi/sicoob-php-sdk/blob/main/docs/CobrancaBancaria/utilizar-modulo-conbranca-bancaria.md), conforme exemplo abaixo:

```php
    $pagador = new Pagador();
    $pagador
        ->setNumeroCpfCnpj('12345678910')
        ->setNome('Joao Da Silva')
        ->setEndereco('Rua 9, QD 1 LT 1')
        ->setBairro('Centro')
        ->setCidade('Morrinhos')
        ->setCep('75650000')
        ->setUf('GO')
        ->setEmail(['pagador@mail.com']);

    $boleto = new Boleto();
    $boleto
        ->setNumeroContaCorrente(0)
        ->setEspecieDocumento(EspecieDocumento::FATURA)
        ->setSeuNumero('123457')
        ->setIdentificacaoEmissaoBoleto(IdentificacaoEmissaoBoleto::BANCO_EMITE)
        ->setIdentificacaoDistribuicaoBoleto(IdentificacaoDistribuicaoBoleto::BANCO_DISTRIBUI)
        ->setValor(100.00)
        ->setDataVencimento((new DateTime('2021-12-10'))->setTime(0, 0)->format('Y-m-d\TH:i:sP'))
        ->setDataEmissao((new DateTime('now'))->setTime(0, 0)->format('Y-m-d\TH:i:sP'))
        ->setPagador($pagador);

    $response = $this->cobrancaBancaria->incluirBoleto($boleto);
```

Se a criação do boleto for bem sucedida o retorno do método será uma instância da classe Boleto, o exemplo acima é a criação de um boleto utiizando os dados obigatório, para saber quais são os dados permitidos na criação, acesso o link abaixo da documentação oficial.

## Referência

- [Documentação Oficial - Incluir Boleto](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#1bcf3134-afbd-4cf3-ba49-9cdf5ea2c224)