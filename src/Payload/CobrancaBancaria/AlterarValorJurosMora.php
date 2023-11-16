<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

use Logics\SicoobSdk\Enum\TipoJurosMora;

class AlterarValorJurosMora extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero, TipoJurosMora $tipoJurosMora, string $dataJurosMora, float $valorJurosMora)
    {
        $this->tipoJurosMora = $tipoJurosMora;
        $this->dataJurosMora = $dataJurosMora;
        $this->valorJurosMora = $valorJurosMora;

        parent::__construct(
            $nossoNumero
        );
    }

    private TipoJurosMora $tipoJurosMora;

    private string $dataJurosMora;

    private float $valorJurosMora;

    public function getTipoJurosMora(): TipoJurosMora
    {
        return $this->tipoJurosMora;
    }

    public function getDataJurosMora(): string
    {
        return $this->dataJurosMora;
    }

    public function getValorJurosMora(): float
    {
        return $this->valorJurosMora;
    }

    public static function createFromJsonArray($data): AlterarValorJurosMora
    {
        return new AlterarValorJurosMora(
            $data->nossoNumero,
            TipoJurosMora::get($data->tipoJurosMora),
            $data->dataJurosMora,
            $data->valorJurosMora
        );
    }
}