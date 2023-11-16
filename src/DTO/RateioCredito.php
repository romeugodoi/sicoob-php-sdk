<?php

namespace Logics\SicoobSdk\DTO;

use Logics\SicoobSdk\Enum\CodigoFinalidadeTED;
use Logics\SicoobSdk\Enum\CodigoTipoCalculoRateio;
use Logics\SicoobSdk\Enum\CodigoTipoContaDestinoTED;
use Logics\SicoobSdk\Enum\CodigoTipoValorRateio;

final class RateioCredito
{
    /**
     * @param int $numeroBanco
     * @param int $numeroAgencia
     * @param int $numeroContaCorrente
     * @param bool $contaPrincipal
     * @param CodigoTipoValorRateio $codigoTipoValorRateio
     * @param float $valorRateio
     * @param CodigoTipoCalculoRateio $codigoTipoCalculoRateio
     * @param string $numeroCpfCnpjTitular
     * @param string $nomeTitular
     * @param CodigoFinalidadeTED $codigoFinalidadeTed
     * @param CodigoTipoContaDestinoTED $codigoTipoContaDestinoTed
     * @param int $quantidadeDiasFloat
     * @param string|null $dataFloatCredito
     */
    public function __construct(
        int $numeroBanco,
        int $numeroAgencia,
        int $numeroContaCorrente,
        bool $contaPrincipal,
        CodigoTipoValorRateio $codigoTipoValorRateio,
        float $valorRateio,
        CodigoTipoCalculoRateio $codigoTipoCalculoRateio,
        string $numeroCpfCnpjTitular,
        string $nomeTitular,
        CodigoFinalidadeTED $codigoFinalidadeTed,
        CodigoTipoContaDestinoTED $codigoTipoContaDestinoTed,
        int $quantidadeDiasFloat,
        ?string $dataFloatCredito = null
    )
    {
        $this->numeroBanco = $numeroBanco;
        $this->numeroAgencia = $numeroAgencia;
        $this->numeroContaCorrente = $numeroContaCorrente;
        $this->contaPrincipal = $contaPrincipal;
        $this->codigoTipoValorRateio = $codigoTipoValorRateio;
        $this->valorRateio = $valorRateio;
        $this->codigoTipoCalculoRateio = $codigoTipoCalculoRateio;
        $this->numeroCpfCnpjTitular = $numeroCpfCnpjTitular;
        $this->nomeTitular = $nomeTitular;
        $this->codigoFinalidadeTed = $codigoFinalidadeTed;
        $this->codigoTipoContaDestinoTed = $codigoTipoContaDestinoTed;
        $this->quantidadeDiasFloat = $quantidadeDiasFloat;
        $this->dataFloatCredito = $dataFloatCredito;
    }

    private int $numeroBanco;

    private int $numeroAgencia;

    private int $numeroContaCorrente;

    private bool $contaPrincipal;

    private CodigoTipoValorRateio $codigoTipoValorRateio;

    private float $valorRateio;

    private CodigoTipoCalculoRateio $codigoTipoCalculoRateio;

    private string $numeroCpfCnpjTitular;

    private string $nomeTitular;

    private CodigoFinalidadeTED $codigoFinalidadeTed;

    private CodigoTipoContaDestinoTED $codigoTipoContaDestinoTed;

    private int $quantidadeDiasFloat;

    private ?string $dataFloatCredito;

    public function getNumeroBanco(): int
    {
        return $this->numeroBanco;
    }

    public function setNumeroBanco(int $numeroBanco): self
    {
        $this->numeroBanco = $numeroBanco;

        return $this;
    }

    public function getNumeroAgencia(): int
    {
        return $this->numeroAgencia;
    }

    public function setNumeroAgencia(int $numeroAgencia): self
    {
        $this->numeroAgencia = $numeroAgencia;

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

    public function isContaPrincipal(): bool
    {
        return $this->contaPrincipal;
    }

    public function setContaPrincipal(bool $contaPrincipal): self
    {
        $this->contaPrincipal = $contaPrincipal;

        return $this;
    }

    public function getCodigoTipoValorRateio(): CodigoTipoValorRateio
    {
        return $this->codigoTipoValorRateio;
    }

    public function setCodigoTipoValorRateio(CodigoTipoValorRateio $codigoTipoValorRateio): self
    {
        $this->codigoTipoValorRateio = $codigoTipoValorRateio;

        return $this;
    }

    public function getValorRateio(): float
    {
        return $this->valorRateio;
    }

    public function setValorRateio(float $valorRateio): self
    {
        $this->valorRateio = $valorRateio;

        return $this;
    }

    public function getCodigoTipoCalculoRateio(): CodigoTipoCalculoRateio
    {
        return $this->codigoTipoCalculoRateio;
    }

    public function setCodigoTipoCalculoRateio(CodigoTipoCalculoRateio $codigoTipoCalculoRateio): self
    {
        $this->codigoTipoCalculoRateio = $codigoTipoCalculoRateio;

        return $this;
    }

    public function getNumeroCpfCnpjTitular(): string
    {
        return $this->numeroCpfCnpjTitular;
    }

    public function setNumeroCpfCnpjTitular(string $numeroCpfCnpjTitular): self
    {
        $this->numeroCpfCnpjTitular = $numeroCpfCnpjTitular;

        return $this;
    }

    public function getNomeTitular(): string
    {
        return $this->nomeTitular;
    }

    public function setNomeTitular(string $nomeTitular): self
    {
        $this->nomeTitular = $nomeTitular;

        return $this;
    }

    public function getCodigoFinalidadeTed(): CodigoFinalidadeTED
    {
        return $this->codigoFinalidadeTed;
    }

    public function setCodigoFinalidadeTed(CodigoFinalidadeTED $codigoFinalidadeTed): self
    {
        $this->codigoFinalidadeTed = $codigoFinalidadeTed;

        return $this;
    }

    public function getCodigoTipoContaDestinoTed(): CodigoTipoContaDestinoTED
    {
        return $this->codigoTipoContaDestinoTed;
    }

    public function setCodigoTipoContaDestinoTed(CodigoTipoContaDestinoTED $codigoTipoContaDestinoTed): self
    {
        $this->codigoTipoContaDestinoTed = $codigoTipoContaDestinoTed;

        return $this;
    }

    public function getQuantidadeDiasFloat(): int
    {
        return $this->quantidadeDiasFloat;
    }

    public function setQuantidadeDiasFloat(int $quantidadeDiasFloat): self
    {
        $this->quantidadeDiasFloat = $quantidadeDiasFloat;

        return $this;
    }

    public function getDataFloatCredito(): ?string
    {
        return $this->dataFloatCredito;
    }

    public function setDataFloatCredito(?string $dataFloatCredito): self
    {
        $this->dataFloatCredito = $dataFloatCredito;

        return $this;
    }

    public function toArray(): array
    {
        $array = [];

        foreach ($this as $key => $value) {
            if($value !== null) {
                $array[$key] = $value;
            }
        }

        return $array;
    }

    public static function createFromJsonArray($data): RateioCredito
    {
        return new RateioCredito(
            $data->numeroBanco,
            $data->numeroAgencia,
            $data->numeroContaCorrente,
            $data->contaPrincipal,
            CodigoTipoValorRateio::get($data->codigoTipoValorRateio),
            $data->valorRateio,
            CodigoTipoCalculoRateio::get($data->codigoTipoCalculoRateio),
            $data->numeroCpfCnpjTitular,
            $data->nomeTitular,
            CodigoFinalidadeTED::get($data->codigoFinalidadeTed),
            CodigoTipoContaDestinoTED::get($data->codigoTipoContaDestinoTed),
            $data->quantidadeDiasFloat,
            $data->dataFloatCredito
        );
    }
}
