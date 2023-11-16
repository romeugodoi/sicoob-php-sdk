<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

use Logics\SicoobSdk\Enum\TipoDesconto;

class AlterarInformacoesDesconto extends BasePayloadCobrancaBancaria
{
    public function __construct(
        int $nossoNumero,
        TipoDesconto $tipoDesconto,
        ?string $dataPrimeiroDesconto = null,
        ?float $valorPrimeiroDesconto = null,
        ?string $dataSegundoDesconto = null,
        ?float $valorSegundoDesconto = null,
        ?string $dataTerceiroDesconto = null,
        ?float $valorTerceiroDesconto = null
    )
    {
        $this->tipoDesconto = $tipoDesconto;
        $this->dataPrimeiroDesconto = $dataPrimeiroDesconto;
        $this->valorPrimeiroDesconto = $valorPrimeiroDesconto;
        $this->dataSegundoDesconto = $dataSegundoDesconto;
        $this->valorSegundoDesconto = $valorSegundoDesconto;
        $this->dataTerceiroDesconto = $dataTerceiroDesconto;
        $this->valorTerceiroDesconto = $valorTerceiroDesconto;

        parent::__construct(
            $nossoNumero
        );
    }

    private TipoDesconto $tipoDesconto;

    private ?string $dataPrimeiroDesconto;

    private ?float $valorPrimeiroDesconto;

    private ?string $dataSegundoDesconto;

    private ?float $valorSegundoDesconto;

    private ?string $dataTerceiroDesconto;

    private ?float $valorTerceiroDesconto;

    public function getTipoDesconto(): TipoDesconto
    {
        return $this->tipoDesconto;
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

    public static function createFromJsonArray($data): AlterarInformacoesDesconto
    {
        return new AlterarInformacoesDesconto(
            $data->nossoNumero,
            TipoDesconto::get($data->tipoDesconto),
            $data?->dataPrimeiroDesconto ?? null,
            $data?->valorPrimeiroDesconto ?? null,
            $data?->dataSegundoDesconto ?? null,
            $data?->valorSegundoDesconto ?? null,
            $data?->dataTerceiroDesconto ?? null,
            $data?->valorTerceiroDesconto ?? null
        );
    }
}