
# Sicoob PHP SDK

Biblioteca para facilitar a integração com a API do banco Sicoob utilizando PHP.

![GitHub release](https://img.shields.io/github/release/romeugodoi/sicoob-php-sdk.svg?color=cadetblue)
![PHP from Packagist](https://img.shields.io/packagist/php-v/rogo/sicoob-php-sdk.svg)
[![Coding Standards](https://img.shields.io/badge/cs-PSR--4-orange.svg)](https://github.com/php-fig-rectified/fig-rectified-standards)
![Packagist](https://img.shields.io/packagist/l/rogo/sicoob-php-sdk.svg?color=yellow)
![Travis (.org) branch](https://img.shields.io/travis/logics/braspag-php-sdk/master.svg)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/romeugodoi/sicoob-php-sdk.svg)

## Funcionalidades

- Integração com a API de Cobrança Bancária

## Documentação

[Documentação](https://github.com/romeugodoi/sicoob-php-sdk/tree/main/docs)

## Instalando o SDK
Caso ainda não possua o Composer instalado, siga as instruções em [getcomposer.org](https://getcomposer.org).

Se já possui um arquivo `composer.json`, basta executar diretamente em seu terminal:

```bash
composer require rogo/sicoob-php-sdk
```

## Exemplos de uso

### Incluir Boleto:

```php
<?php
require 'vendor/autoload.php';

// Criando instância de Authenticator que fará o controle de autenticação
$authenticator = new Authenticator(
    '9b5e603e428cc477a2841e2683c92d21', //clientId
    'certificate', //path_to_certificate
    'certificate_key', //path_to_certificate_key
    true //isSandbox
)

// Criando instância de CobrancaBancaria para utilizar todos os métodos do módulo de cobrança bancária
new CobrancaBancaria(
    $authenticator
    25546454 //numeroContrato
);

// Criando instância de Pagador
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

// Criando instância de Boleto
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

// Incluindo boleto
$response = $this->cobrancaBancaria->incluirBoleto($boleto);

// Acessando informações do boleto
$nossoNumero = $response->getNossoNumero();
```

## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
  composer install
  ./vendor/bin/phpunit src/tests
```


## Licença

[MIT](https://choosealicense.com/licenses/mit/)

