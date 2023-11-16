<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class NegativarPagadores extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero)
    {
        parent::__construct($nossoNumero);
    }

    public static function createFromJsonArray($data): NegativarPagadores
    {
        return new NegativarPagadores(
            $data->nossoNumero,
        );
    }
}