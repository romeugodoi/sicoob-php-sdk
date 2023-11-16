<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

use Logics\SicoobSdk\Enum\TipoMulta;

class AlterarValorMulta extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero, TipoMulta $tipoMulta, string $dataMulta, float $valorMulta)
    {
        $this->tipoMulta = $tipoMulta;
        $this->dataMulta = $dataMulta;
        $this->valorMulta = $valorMulta;

        parent::__construct(
            $nossoNumero
        );
    }

    private TipoMulta $tipoMulta;

    private string $dataMulta;

    private float $valorMulta;

    public function getTipoMulta(): TipoMulta
    {
        return $this->tipoMulta;
    }

    public function getDataMulta(): string
    {
        return $this->dataMulta;
    }

    public function getValorMulta(): float
    {
        return $this->valorMulta;
    }

    public static function createFromJsonArray($data): AlterarValorMulta
    {
        return new AlterarValorMulta(
            $data->nossoNumero,
            TipoMulta::get($data->tipoMulta),
            $data->dataMulta,
            $data->valorMulta
        );
    }
}