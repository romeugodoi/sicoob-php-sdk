# Autenticação
Para utilizar todas as funcionalidades da biblioteca é necessário primeiramente criar uma instância da classe Authenticator, que fará todo o controle de autenticação, busca e atualização de tokens. Segue abaixo exemplo de instanciação:

```php
    new Authenticator(
        '9b5e603e428cc477a2841e2683c92d21', //clientId
        'certificate', //path_to_certificate
        'certificate_key', //path_to_certificate_key
        true //isSandbox
    ),
```
