<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class BaixarNegativacao extends BasePayloadCobrancaBancaria
{

    public function __construct(int $nossoNumero)
    {
        parent::__construct($nossoNumero);
    }

    public static function createFromJsonArray($data): BaixarNegativacao
    {
        return new BaixarNegativacao(
            $data->nossoNumero,
        );
    }
}