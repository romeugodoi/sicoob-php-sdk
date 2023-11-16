<?php

namespace Logics\SicoobSdk\tests;

use DateTime;
use Logics\SicoobSdk\Authenticator;
use Logics\SicoobSdk\CobrancaBancaria;
use Logics\SicoobSdk\DTO\Boleto;
use Logics\SicoobSdk\DTO\Pagador;
use Logics\SicoobSdk\DTO\RateioCredito;
use Logics\SicoobSdk\Enum\CodigoFinalidadeTED;
use Logics\SicoobSdk\Enum\CodigoSituacaoParam;
use Logics\SicoobSdk\Enum\CodigoTipoCalculoRateio;
use Logics\SicoobSdk\Enum\CodigoTipoContaDestinoTED;
use Logics\SicoobSdk\Enum\CodigoTipoValorRateio;
use Logics\SicoobSdk\Enum\EspecieDocumento;
use Logics\SicoobSdk\Enum\IdentificacaoDistribuicaoBoleto;
use Logics\SicoobSdk\Enum\IdentificacaoEmissaoBoleto;
use Logics\SicoobSdk\Enum\TipoDesconto;
use Logics\SicoobSdk\Enum\TipoJurosMora;
use Logics\SicoobSdk\Enum\TipoMovimentacao;
use Logics\SicoobSdk\Enum\TipoMulta;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarEspecieDocumento;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarInformacoesDesconto;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarInformacoesPagador;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarParaUtilizarPIX;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarSeuNumeroIdBoletoEmpresa;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarValorAbatimento;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarValorJurosMora;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarValorMulta;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarValorNominalBoletoCartaoCredito;
use Logics\SicoobSdk\Payload\CobrancaBancaria\BaixarNegativacao;
use Logics\SicoobSdk\Payload\CobrancaBancaria\CancelarApontamentoNegativacao;
use Logics\SicoobSdk\Payload\CobrancaBancaria\CancelarApontamentoProtesto;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ComandarBaixa;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ComandarRateioCredito;
use Logics\SicoobSdk\Payload\CobrancaBancaria\DesistirProtesto;
use Logics\SicoobSdk\Payload\CobrancaBancaria\NegativarPagadores;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ProrrogarDataLimitePagamento;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ProrrogarDataVencimento;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ProtestarBoleto;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestStatus\Notice;
use PHPUnit\Framework\TestStatus\Warning;
use function PHPUnit\Framework\isInstanceOf;

final class CobrancaBancariaTest extends TestCase
{
    private CobrancaBancaria $cobrancaBancaria;

    public function setUp(): void
    {
       $this->cobrancaBancaria = new CobrancaBancaria(
            new Authenticator(
                '9b5e603e428cc477a2841e2683c92d21',
                'certificate',
                'certificate_key',
                true
            ),
            25546454
        );
    }

    public function testCanBeCreatedBoletoFromValidPayload(): void
    {
        try {
            $pagador = new Pagador();
            $pagador
                ->setNumeroCpfCnpj('70030496195')
                ->setNome('Rharison Lucas Moreira Abreu')
                ->setEndereco('Rua CP 9, QD 20 LT 30')
                ->setBairro('Cristina Park II')
                ->setCidade('Morrinhos')
                ->setCep('75650000')
                ->setUf('GO')
                ->setEmail(['rharison.abreu@gmail.com']);

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

            $this->assertInstanceOf(Boleto::class, $response);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeRetrivedBoleto(): void
    {
        try {
            $boleto = $this->cobrancaBancaria->consultarBoleto('34191090022001300000000000000000000000000000');

            $this->assertInstanceOf(Boleto::class, $boleto);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeRetrievedListOfBoletosByPagador(): void
    {
        try {
            $response = $this->cobrancaBancaria->listarBoletosPorPagador(
                CodigoSituacaoParam::BAIXADO,
                (new DateTime('2021-01-01'))->setTime(0,0)->format('Y-m-d'),
                (new DateTime('2021-12-31'))->setTime(0,0)->format('Y-m-d'),
                '70030496195'
            );


            $this->assertIsArray($response['boletos']);

            foreach ($response['boletos'] as $boleto) {
                $this->assertInstanceOf(Boleto::class, $boleto);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeExtendDueDateBoletos(): void
    {
        try {
            $payload = [
                new ProrrogarDataVencimento(
                    2588658,
                    (new DateTime('now'))->setTime(0,0)->format('Y-m-d\TH:i:sP')
                )
            ];

            $response = $this->cobrancaBancaria->prorrogarDataVencimentoBoletos($payload);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(ProrrogarDataVencimento::class, $itemResponse['prorrogacao']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeIssuedSecondViaBoleto(): void
    {
        try {
            $boleto = $this->cobrancaBancaria->emitirSegundaViaBoleto(false, '34191090022001300000000000000000000000000000');

            $this->assertInstanceOf(Boleto::class, $boleto);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeExtendedLimitDatePaymentBoletos(): void
    {
        try {
            $data = [
                new ProrrogarDataLimitePagamento(
                    2588658,
                    (new DateTime('now'))->setTime(0,0)->format('Y-m-d\TH:i:sP')
                )
            ];

            $response = $this->cobrancaBancaria->prorrogarDataLimitePagamentoBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(ProrrogarDataLimitePagamento::class, $itemResponse['prorrogacao']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeChangedDiscountInformationBoletos(): void
    {
        try {
            $data = [
                new AlterarInformacoesDesconto(
                    2588658,
                    TipoDesconto::SEM_DESCONTO,
                )
            ];

            $response = $this->cobrancaBancaria->alterarInformacoesDescontoBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(AlterarInformacoesDesconto::class, $itemResponse['desconto']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeChangedValueReductionBoletos(): void
    {
        try {
            $data = [
                new AlterarValorAbatimento(
                    2588658,
                    10.0,
                ),
            ];

            $response = $this->cobrancaBancaria->alterarValorAbatimentoBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(AlterarValorAbatimento::class, $itemResponse['abatimento']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeChangedValueFineBoletos(): void
    {
        try {
            $data = [
                new AlterarValorMulta(
                    2588658,
                    TipoMulta::VALOR_FIXO,
                    "2018-09-20T00:00:00-03:00",
                    5
                ),
            ];

            $response = $this->cobrancaBancaria->alterarValorMultaBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(AlterarValorMulta::class, $itemResponse['encargo']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeChangedMoraInterestBoletos(): void
    {
        try {
            $data = [
                new AlterarValorJurosMora(
                    2588658,
                    TipoJurosMora::VALOR_FIXO,
                    "2018-09-20T00:00:00-03:00",
                    5
                ),
            ];

            $response = $this->cobrancaBancaria->alterarValorJurosMoraBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(AlterarValorJurosMora::class, $itemResponse['encargo']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeChangedValueNominalBoletosCreditCard(): void
    {
        try {
            $data = [
                new AlterarValorNominalBoletoCartaoCredito(
                    2588658,
                    10.0,
                ),
            ];

            $response = $this->cobrancaBancaria->alterarValorNominalBoletosCartaoCredito($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(AlterarValorNominalBoletoCartaoCredito::class, $itemResponse['valorNominal']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeChangedYourNumberOrIdBoletoEmpresaBoletos(): void
    {
        try {
            $data = [
                new AlterarSeuNumeroIdBoletoEmpresa(
                    2588658,
                    '123456',
                )
            ];

            $response = $this->cobrancaBancaria->alterarSeuNumeroOuIdBoletoEmpresaBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(AlterarSeuNumeroIdBoletoEmpresa::class, $itemResponse['seu-numero']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeChangedDocumentSpeciesBoletos(): void
    {
        try {
            $data = [
                new AlterarEspecieDocumento(
                    2588658,
                    EspecieDocumento::FATURA,
                ),
            ];

            $response = $this->cobrancaBancaria->alterarEspecieDocumentoBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(AlterarEspecieDocumento::class, $itemResponse['especie-documento']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToCommandUnsubscribeBoletos(): void
    {
        try {
            $data = [
                new ComandarBaixa(
                    2588658,
                    '123456',
                ),
            ];

            $response = $this->cobrancaBancaria->comandarBaixaBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(ComandarBaixa::class, $itemResponse['baixa']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToCommandCreditDistributionBoletos(): void
    {
        try {
            $data = [
                new ComandarRateioCredito(
                    2588658,
                    [
                        new RateioCredito(
                            1,
                            5191,
                            1,
                            true,
                            CodigoTipoValorRateio::PERCENTUAL,
                            65.00,
                            CodigoTipoCalculoRateio::VALOR_COBRADO,
                            '12345678901',
                            'Rharison Lucas Moreira Abreu',
                            CodigoFinalidadeTED::CREDITO_EM_CONTA,
                            CodigoTipoContaDestinoTED::CONTA_CORRENTE,
                            1,
                        )
                    ],
                )
            ];

            $response = $this->cobrancaBancaria->comandarRateioCreditoBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(ComandarRateioCredito::class, $itemResponse['boletos']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToChangeForUsePixBoletos(): void
    {
        try {
            $data = [
                new AlterarParaUtilizarPIX(
                    2588658
                )
            ];

            $response = $this->cobrancaBancaria->alterarBoletoParaUtilizarPix($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(AlterarParaUtilizarPIX::class, $itemResponse['pix']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToChangePayerInformationBoletos(): void
    {
        try {
            $pagador = new Pagador();
            $pagador
                ->setNumeroCpfCnpj('12345678')
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

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(AlterarInformacoesPagador::class, $itemResponse['pagador']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToUnsubscribeNegativationPayers(): void
    {
        try {
            $data = [
                new BaixarNegativacao(
                    2588658,
                ),
            ];

            $response = $this->cobrancaBancaria->baixarNegativacaoPagadores($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(BaixarNegativacao::class, $itemResponse['negativacao']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToNegativatePayers(): void
    {
        try {
            $data = [
                new NegativarPagadores(
                    2588658
                )
            ];

            $response = $this->cobrancaBancaria->negativarPagadores($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(NegativarPagadores::class, $itemResponse['negativacao']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToCancelNegativationPayers(): void
    {
        try {
            $data = [
                new CancelarApontamentoNegativacao(
                    2588658
                )
            ];

            $response = $this->cobrancaBancaria->cancelarApontamentoNegativacaoPagadores($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(CancelarApontamentoNegativacao::class, $itemResponse['negativacao']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToGiveUpProtestBoletos(): void
    {
        try {
            $data = [
                new DesistirProtesto(
                    2588658
                )
            ];

            $response = $this->cobrancaBancaria->desistitProtestoBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(DesistirProtesto::class, $itemResponse['protesto']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToCancelProtestBoletos(): void
    {
        try {
            $data = [
                new CancelarApontamentoProtesto(
                    2588658
                )
            ];

            $response = $this->cobrancaBancaria->cancelarApontamentoProtestoBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(CancelarApontamentoProtesto::class, $itemResponse['protesto']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToProtestBoletos()
    {
        try {
            $data = [
                new ProtestarBoleto(
                    2588658
                )
            ];

            $response = $this->cobrancaBancaria->protestarBoletos($data);

            foreach ($response as $itemResponse) {
                $this->assertEquals(200, $itemResponse['result']->getCodigo());
                $this->assertInstanceOf(ProtestarBoleto::class, $itemResponse['protesto']);
            }
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }


    public function testCanBeToSolicitMovimentationBeneficiaryWallet()
    {
        try {
            $response = $this->cobrancaBancaria->solicitarMovimentacaoCarteiraBeneficiario(
                TipoMovimentacao::BAIXA,
                "2018-09-20T00:00:00-03:00",
                "2018-09-20T00:00:00-03:00",
            );

            $this->assertEquals(201, $response['statusCode']);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToConsultSituationSolicitationMovimentation()
    {
        try {
            $response = $this->cobrancaBancaria->consultarSituacaoSolicitacaoMovimentacao(
                132,
            );

            $this->assertEquals(200, $response['statusCode']);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCanBeToDownloadFileMovimentation()
    {
        try {
            $response = $this->cobrancaBancaria->downloadArquivoMovimentacao(
                132,
                12345
            );

            $this->assertEquals(200, $response['statusCode']);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}