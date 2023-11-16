# Alterar informações de pagadores de boletos

Parâmetros:
- Array de objetos da classe Payload/AlterarInformacoesPagador

<b>Observação: </b>A quantidade máxima de boletos quer alterados por requisição é de 10, de acordo com a documentação oficial.

```php
    $pagador = new Pagador();
    $pagador
        ->setNumeroCpfCnpj('12345678910')
        ->setNome('Rharison Lucas')
        ->setEndereco('Rua 9, QD 1 LT 2')
        ->setBairro('Cristina Park II')
        ->setCidade('Morrinhos')
        ->setCep('75650000')
        ->setUf('GO')
        ->addEmail('contato@gmail.com');

    $data = [
        new AlterarInformacoesPagador(
            2588658,
            $pagador
        ),
    ];

    $response = $this->cobrancaBancaria->alterarInformacoesPagadorBoletos($data);
```

## Referência

- [Documentação Oficial - Alterar informações de pagadores de boletos](https://documenter.getpostman.com/view/20565799/Uzs6yNhe#304f14b0-83be-4a4c-b30e-9bfbb3d5ac6c)