<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class ProtestarBoleto extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero)
    {
        parent::__construct($nossoNumero);
    }

    public static function createFromJsonArray($data): ProtestarBoleto
    {
        return new ProtestarBoleto(
            $data->nossoNumero,
        );
    }
}