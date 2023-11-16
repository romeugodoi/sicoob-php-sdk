<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

use Logics\SicoobSdk\DTO\Pagador;

class AlterarInformacoesPagador extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero, Pagador $pagador)
    {
        $this->pagador = $pagador;

        parent::__construct($nossoNumero);
    }

    private Pagador $pagador;

    public function getPagador(): Pagador
    {
        return $this->pagador;
    }

    public static function createFromJsonArray($data): AlterarInformacoesPagador
    {
        return new AlterarInformacoesPagador(
            $data->nossoNumero,
            Pagador::createFromJsonArray($data)
        );
    }
}