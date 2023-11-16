<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class DesistirProtesto extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero)
    {
        parent::__construct($nossoNumero);
    }

    public static function createFromJsonArray($data): DesistirProtesto
    {
        return new DesistirProtesto(
            $data->nossoNumero,
        );
    }
}