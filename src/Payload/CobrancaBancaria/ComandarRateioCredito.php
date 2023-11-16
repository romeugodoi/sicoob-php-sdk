<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

use Logics\SicoobSdk\DTO\RateioCredito;

class ComandarRateioCredito extends BasePayloadCobrancaBancaria
{
    private array $rateiosCredito;

    /**
     * @param int $nossoNumero
     * @param RateioCredito[] $rateiosCredito
     */
    public function __construct(int $nossoNumero, array $rateiosCredito)
    {
        $this->rateiosCredito = $rateiosCredito;

        parent::__construct($nossoNumero);
    }

    public function getRateiosCredito(): array
    {
        return $this->rateiosCredito;
    }

    public static function createFromJsonArray($data): ComandarRateioCredito
    {
        return new ComandarRateioCredito(
            $data->nossoNumero,
            array_map(
                fn ($rateioCredito) => RateioCredito::createFromJsonArray($rateioCredito),
                $data->rateioCreditos
            )
        );
    }
}