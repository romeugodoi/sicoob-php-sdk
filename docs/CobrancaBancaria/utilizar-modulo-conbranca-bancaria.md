# Utilizando módulo de cobranças bancárias

Para utilização do módulo de cobranças bancárias, primeiramente se faz necessário ter uma instância da classe [Authenticator](https://github.com/romeugodoi/sicoob-php-sdk/blob/main/docs/CobrancaBancaria/autheticator.md) que será enviada como argumento no construtor para criação de uma instância da classe CobrancaBancaria:

```php
   new CobrancaBancaria(
        $authenticatorInstance
        25546454 //numeroContrato
    );
```

Obs: Por ser uma informação que se repete em todos os métodos do módulo de cobrança bancária o número do contrato deverá ser informado como segundo argumento do construtor, e será repassado internamente para os métodos que necessitarem dessa informação.
