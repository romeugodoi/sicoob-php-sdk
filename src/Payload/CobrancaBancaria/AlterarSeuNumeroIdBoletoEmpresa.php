<?php

namespace Logics\SicoobSdk\Payload\CobrancaBancaria;

class AlterarSeuNumeroIdBoletoEmpresa extends BasePayloadCobrancaBancaria
{
    public function __construct(
        int $nossoNumero,
        ?string $seuNumero = null,
        ?string $identificacaoBoletoEmpresa = null
    )
    {
        $this->seuNumero = $seuNumero;
        $this->identificacaoBoletoEmpresa = $identificacaoBoletoEmpresa;

        parent::__construct(
            $nossoNumero
        );
    }

    private ?string $seuNumero;

    private ?string $identificacaoBoletoEmpresa;

    public function getSeuNumero(): ?string
    {
        return $this->seuNumero;
    }

    public function getIdentificacaoBoletoEmpresa(): ?string
    {
        return $this->identificacaoBoletoEmpresa;
    }

    public static function createFromJsonArray($data): AlterarSeuNumeroIdBoletoEmpresa
    {
        return new AlterarSeuNumeroIdBoletoEmpresa(
            $data['nossoNumero'],
            $data['seuNumero'] ?? null,
            $data['identificacaoBoletoEmpresa'] ?? null
        );
    }
}