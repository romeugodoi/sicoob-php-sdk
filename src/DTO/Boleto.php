<?php

namespace Logics\SicoobSdk\DTO;

use Logics\SicoobSdk\Enum\CodigoCadastrarPIX;
use Logics\SicoobSdk\Enum\CodigoNegativacao;
use Logics\SicoobSdk\Enum\CodigoProtesto;
use Logics\SicoobSdk\Enum\CodigoSituacao;
use Logics\SicoobSdk\Enum\EspecieDocumento;
use Logics\SicoobSdk\Enum\IdentificacaoEmissaoBoleto;
use Logics\SicoobSdk\Enum\Modalidade;
use Logics\SicoobSdk\Enum\IdentificacaoDistribuicaoBoleto;
use Logics\SicoobSdk\Enum\TipoDesconto;
use Logics\SicoobSdk\Enum\TipoJurosMora;
use Logics\SicoobSdk\Enum\TipoMulta;

class Boleto
{
    private int $numeroContrato;

    private Modalidade $modalidade = Modalidade::SIMPLES_COM_REGISTRO;

    private int $numeroContaCorrente;

    private EspecieDocumento $especieDocumento;

    private string $dataEmissao;

    private ?int $nossoNumero;

    private ?string $seuNumero;

    private ?string $identificacaoBoletoEmpresa;

    private IdentificacaoEmissaoBoleto $identificacaoEmissaoBoleto;

    private IdentificacaoDistribuicaoBoleto $identificacaoDistribuicaoBoleto;

    private float $valor;

    private string $dataVencimento;

    private ?string $dataLimitePagamento;

    private ?float $valorAbatimento;

    private TipoDesconto $tipoDesconto = TipoDesconto::SEM_DESCONTO;

    private ?string $dataPrimeiroDesconto;

    private ?float $valorPrimeiroDesconto;

    private ?string $dataSegundoDesconto;

    private ?float $valorSegundoDesconto;

    private ?string $dataTerceiroDesconto;

    private ?float $valorTerceiroDesconto;

    private TipoMulta $tipoMulta = TipoMulta::ISENTO;

    private ?string $dataMulta;

    private ?float $valorMulta;

    private TipoJurosMora $tipoJurosMora = TipoJurosMora::ISENTO;

    private ?string $dataJurosMora;

    private ?float $valorJurosMora;

    private int $numeroParcela = 1;

    private ?bool $aceite;

    private ?CodigoNegativacao $codigoNegativacao;

    private ?int $numeroDiasNegativacao;

    private ?CodigoProtesto $codigoProtesto;

    private ?int $numeroDiasProtesto;

    private Pagador $pagador;

    private ?BeneficiarioFinal $beneficiarioFinal;

    private ?MensagemInstrucao $mensagensInstrucao;

    private ?bool $gerarPdf;

    /**
     * @var RateioCredito[]
     */
    private ?array $rateioCreditos;

    private ?CodigoCadastrarPIX $codigoCadastrarPIX;

    private ?string $codigoBarras;

    private ?string $linhaDigitavel;

    private ?string $pdfBoleto;

    private ?string $qrCode;

    private ?CodigoSituacao $situacaoBoleto;

    public function getNumeroContrato(): int
    {
        return $this->numeroContrato;
    }

    public function setNumeroContrato(int $numeroContrato): self
    {
        $this->numeroContrato = $numeroContrato;

        return $this;
    }

    public function getModalidade(): Modalidade
    {
        return $this->modalidade;
    }

    public function setModalidade(Modalidade $modalidade): self
    {
        $this->modalidade = $modalidade;

        return $this;
    }

    public function getNumeroContaCorrente(): int
    {
        return $this->numeroContaCorrente;
    }

    public function setNumeroContaCorrente(int $numeroContaCorrente): self
    {
        $this->numeroContaCorrente = $numeroContaCorrente;

        return $this;
    }

    public function getEspecieDocumento(): EspecieDocumento
    {
        return $this->especieDocumento;
    }

    public function setEspecieDocumento(EspecieDocumento $especieDocumento): self
    {
        $this->especieDocumento = $especieDocumento;

        return $this;
    }

    public function getDataEmissao(): ?string
    {
        return $this->dataEmissao;
    }

    public function setDataEmissao(?string $dataEmissao): self
    {
        $this->dataEmissao = $dataEmissao;

        return $this;
    }

    public function getNossoNumero(): ?int
    {
        return $this->nossoNumero;
    }

    public function setNossoNumero(?int $nossoNumero): self
    {
        $this->nossoNumero = $nossoNumero;

        return $this;
    }

    public function getSeuNumero(): ?string
    {
        return $this->seuNumero;
    }

    public function setSeuNumero(?string $seuNumero): self
    {
        $this->seuNumero = $seuNumero;

        return $this;
    }

    public function getIdentificacaoBoletoEmpresa(): ?string
    {
        return $this->identificacaoBoletoEmpresa;
    }

    public function setIdentificacaoBoletoEmpresa(?string $identificacaoBoletoEmpresa): self
    {
        $this->identificacaoBoletoEmpresa = $identificacaoBoletoEmpresa;

        return $this;
    }

    public function getIdentificacaoEmissaoBoleto(): IdentificacaoEmissaoBoleto
    {
        return $this->identificacaoEmissaoBoleto;
    }

    public function setIdentificacaoEmissaoBoleto(IdentificacaoEmissaoBoleto $identificacaoEmissaoBoleto): self
    {
        $this->identificacaoEmissaoBoleto = $identificacaoEmissaoBoleto;

        return $this;
    }

    public function getIdentificacaoDistribuicaoBoleto(): IdentificacaoDistribuicaoBoleto
    {
        return $this->identificacaoDistribuicaoBoleto;
    }

    public function setIdentificacaoDistribuicaoBoleto(IdentificacaoDistribuicaoBoleto $identificacaoDistribuicaoBoleto): self
    {
        $this->identificacaoDistribuicaoBoleto = $identificacaoDistribuicaoBoleto;

        return $this;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getDataVencimento(): string
    {
        return $this->dataVencimento;
    }

    public function setDataVencimento(string $dataVencimento): self
    {
        $this->dataVencimento = $dataVencimento;

        return $this;
    }

    public function getDataLimitePagamento(): ?string
    {
        return $this->dataLimitePagamento;
    }

    public function setDataLimitePagamento(?string $dataLimitePagamento): self
    {
        $this->dataLimitePagamento = $dataLimitePagamento;

        return $this;
    }

    public function getValorAbatimento(): ?float
    {
        return $this->valorAbatimento;
    }

    public function setValorAbatimento(?float $valorAbatimento): self
    {
        $this->valorAbatimento = $valorAbatimento;

        return $this;
    }

    public function getTipoDesconto(): TipoDesconto
    {
        return $this->tipoDesconto;
    }

    public function setTipoDesconto(TipoDesconto $tipoDesconto): self
    {
        $this->tipoDesconto = $tipoDesconto;

        return $this;
    }

    public function getDataPrimeiroDesconto(): ?string
    {
        return $this->dataPrimeiroDesconto;
    }

    public function setDataPrimeiroDesconto(?string $dataPrimeiroDesconto): self
    {
        $this->dataPrimeiroDesconto = $dataPrimeiroDesconto;

        return $this;
    }

    public function getValorPrimeiroDesconto(): ?float
    {
        return $this->valorPrimeiroDesconto;
    }

    public function setValorPrimeiroDesconto(?float $valorPrimeiroDesconto): self
    {
        $this->valorPrimeiroDesconto = $valorPrimeiroDesconto;

        return $this;
    }

    public function getDataSegundoDesconto(): ?string
    {
        return $this->dataSegundoDesconto;
    }

    public function setDataSegundoDesconto(?string $dataSegundoDesconto): self
    {
        $this->dataSegundoDesconto = $dataSegundoDesconto;

        return $this;
    }

    public function getValorSegundoDesconto(): ?float
    {
        return $this->valorSegundoDesconto;
    }

    public function setValorSegundoDesconto(?float $valorSegundoDesconto): self
    {
        $this->valorSegundoDesconto = $valorSegundoDesconto;

        return $this;
    }

    public function getDataTerceiroDesconto(): ?string
    {
        return $this->dataTerceiroDesconto;
    }

    public function setDataTerceiroDesconto(?string $dataTerceiroDesconto): self
    {
        $this->dataTerceiroDesconto = $dataTerceiroDesconto;

        return $this;
    }

    public function getValorTerceiroDesconto(): ?float
    {
        return $this->valorTerceiroDesconto;
    }

    public function setValorTerceiroDesconto(?float $valorTerceiroDesconto): self
    {
        $this->valorTerceiroDesconto = $valorTerceiroDesconto;

        return $this;
    }

    public function getTipoMulta(): TipoMulta
    {
        return $this->tipoMulta;
    }

    public function setTipoMulta(TipoMulta $tipoMulta): self
    {
        $this->tipoMulta = $tipoMulta;

        return $this;
    }

    public function getDataMulta(): ?string
    {
        return $this->dataMulta;
    }

    public function setDataMulta(?string $dataMulta): self
    {
        $this->dataMulta = $dataMulta;

        return $this;
    }

    public function getValorMulta(): ?float
    {
        return $this->valorMulta;
    }

    public function setValorMulta(?float $valorMulta): self
    {
        $this->valorMulta = $valorMulta;

        return $this;
    }

    public function getTipoJurosMora(): TipoJurosMora
    {
        return $this->tipoJurosMora;
    }

    public function setTipoJurosMora(TipoJurosMora $tipoJurosMora): self
    {
        $this->tipoJurosMora = $tipoJurosMora;

        return $this;
    }

    public function getDataJurosMora(): ?string
    {
        return $this->dataJurosMora;
    }

    public function setDataJurosMora(?string $dataJurosMora): self
    {
        $this->dataJurosMora = $dataJurosMora;

        return $this;
    }

    public function getValorJurosMora(): ?float
    {
        return $this->valorJurosMora;
    }

    public function setValorJurosMora(?float $valorJurosMora): self
    {
        $this->valorJurosMora = $valorJurosMora;

        return $this;
    }

    public function getNumeroParcela(): int
    {
        return $this->numeroParcela;
    }

    public function setNumeroParcela(int $numeroParcela): self
    {
        $this->numeroParcela = $numeroParcela;

        return $this;
    }

    public function getAceite(): ?bool
    {
        return $this->aceite;
    }

    public function setAceite(?bool $aceite): self
    {
        $this->aceite = $aceite;

        return $this;
    }

    public function getCodigoNegativacao(): ?CodigoNegativacao
    {
        return $this->codigoNegativacao;
    }

    public function setCodigoNegativacao(?CodigoNegativacao $codigoNegativacao): self
    {
        $this->codigoNegativacao = $codigoNegativacao;

        return $this;
    }

    public function getNumeroDiasNegativacao(): ?int
    {
        return $this->numeroDiasNegativacao;
    }

    public function setNumeroDiasNegativacao(?int $numeroDiasNegativacao): self
    {
        $this->numeroDiasNegativacao = $numeroDiasNegativacao;

        return $this;
    }

    public function getCodigoProtesto(): ?CodigoProtesto
    {
        return $this->codigoProtesto;
    }

    public function setCodigoProtesto(?CodigoProtesto $codigoProtesto): self
    {
        $this->codigoProtesto = $codigoProtesto;

        return $this;
    }

    public function getNumeroDiasProtesto(): ?int
    {
        return $this->numeroDiasProtesto;
    }

    public function setNumeroDiasProtesto(?int $numeroDiasProtesto): self
    {
        $this->numeroDiasProtesto = $numeroDiasProtesto;

        return $this;
    }

    public function getPagador(): Pagador
    {
        return $this->pagador;
    }

    public function setPagador(Pagador $pagador): self
    {
        $this->pagador = $pagador;

        return $this;
    }

    public function getBeneficiarioFinal(): ?BeneficiarioFinal
    {
        return $this->beneficiarioFinal;
    }

    public function setBeneficiarioFinal(?BeneficiarioFinal $beneficiarioFinal): self
    {
        $this->beneficiarioFinal = $beneficiarioFinal;

        return $this;
    }

    public function getMensagensInstrucao(): ?MensagemInstrucao
    {
        return $this->mensagensInstrucao;
    }

    public function setMensagensInstrucao(?MensagemInstrucao $mensagensInstrucao): self
    {
        $this->mensagensInstrucao = $mensagensInstrucao;

        return $this;
    }

    public function getGerarPdf(): ?bool
    {
        return $this->gerarPdf;
    }

    public function setGerarPdf(?bool $gerarPdf): self
    {
        $this->gerarPdf = $gerarPdf;

        return $this;
    }

    public function getRateioCreditos(): ?array
    {
        return $this->rateioCreditos;
    }

    public function setRateioCreditos(?array $rateioCreditos): self
    {
        $this->rateioCreditos = $rateioCreditos;

        return $this;
    }

    public function getCodigoCadastrarPIX(): ?CodigoCadastrarPIX
    {
        return $this->codigoCadastrarPIX;
    }

    public function setCodigoCadastrarPIX(?CodigoCadastrarPIX $codigoCadastrarPIX): self
    {
        $this->codigoCadastrarPIX = $codigoCadastrarPIX;

        return $this;
    }

    public function getCodigoBarras(): ?string
    {
        return $this->codigoBarras;
    }

    public function setCodigoBarras(?string $codigoBarras): self
    {
        $this->codigoBarras = $codigoBarras;

        return $this;
    }

    public function getLinhaDigitavel(): ?string
    {
        return $this->linhaDigitavel;
    }

    public function setLinhaDigitavel(?string $linhaDigitavel): self
    {
        $this->linhaDigitavel = $linhaDigitavel;

        return $this;
    }

    public function getPdfBoleto(): ?string
    {
        return $this->pdfBoleto;
    }

    public function setPdfBoleto(?string $pdfBoleto): self
    {
        $this->pdfBoleto = $pdfBoleto;

        return $this;
    }

    public function getQrCode(): ?string
    {
        return $this->qrCode;
    }

    public function setQrCode(?string $qrCode): self
    {
        $this->qrCode = $qrCode;

        return $this;
    }

    public function getSituacaoBoleto(): ?CodigoSituacao
    {
        return $this->situacaoBoleto;
    }

    public function setSituacaoBoleto(?CodigoSituacao $situacaoBoleto): self
    {
        $this->situacaoBoleto = $situacaoBoleto;

        return $this;
    }


    public static function createFromJsonArray($data): Boleto
    {
        $boleto = new Boleto();

        foreach ($data as $key => $value) {
            if (property_exists($boleto, $key)) {
                $boleto->$key = self::convertValueByKey($key, $value);
            }
        }

        return $boleto;
    }

    private static function convertValueByKey(string $key, mixed $value): mixed
    {
        return match ($key) {
            'modalidade' => Modalidade::get($value),
            'especieDocumento' => EspecieDocumento::get($value),
            'identificacaoEmissaoBoleto' => IdentificacaoEmissaoBoleto::get($value),
            'identificacaoDistribuicaoBoleto' => IdentificacaoDistribuicaoBoleto::get($value),
            'tipoDesconto' => TipoDesconto::get($value),
            'tipoMulta' => TipoMulta::get($value),
            'tipoJurosMora' => TipoJurosMora::get($value),
            'codigoNegativacao' => CodigoNegativacao::get($value),
            'codigoProtesto' => CodigoProtesto::get($value),
            'pagador' => Pagador::createFromJsonArray($value),
            'beneficiarioFinal' => BeneficiarioFinal::createFromJsonArray($value),
            'mensagensInstrucao' => MensagemInstrucao::createFromJsonArray($value),
            'situacaoBoleto' => CodigoSituacao::get($value),
            default => $value,
        };
    }

    public function toArray(): array
    {
        $array = [];

        foreach ($this as $key => $value) {
            if ($value instanceof Pagador) {
                $array[$key] = $value->toArray();
            } else {
                $array[$key] = $value;
            }
        }

        return $array;
    }
}