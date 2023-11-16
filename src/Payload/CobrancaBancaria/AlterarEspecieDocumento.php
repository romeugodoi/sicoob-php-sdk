<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

use Logics\SicoobSdk\Enum\EspecieDocumento;

class AlterarEspecieDocumento extends BasePayloadCobrancaBancaria
{
    public function __construct(int $nossoNumero, EspecieDocumento $especieDocumento)
    {
        $this->especieDocumento = $especieDocumento;

        parent::__construct($nossoNumero);
    }

    private EspecieDocumento $especieDocumento;

    public function getEspecieDocumento(): EspecieDocumento
    {
        return $this->especieDocumento;
    }

    public static function createFromJsonArray($data): AlterarEspecieDocumento
    {
        return new AlterarEspecieDocumento(
            $data['nossoNumero'],
           EspecieDocumento::get($data['especieDocumento'])
        );
    }
}