<?php

namespace Logics\SicoobSdk\DTO;

final class BeneficiarioFinal
{
    private string $numeroCpfCnpj;

    private string $nome;

    public function getNumeroCpfCnpj(): string
    {
        return $this->numeroCpfCnpj;
    }

    public function setNumeroCpfCnpj(string $numeroCpfCnpj): self
    {
        $this->numeroCpfCnpj = $numeroCpfCnpj;

        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }


    public static function createFromJsonArray($data): BeneficiarioFinal
    {
        $beneficiarioFinal = new BeneficiarioFinal();

        foreach ($data as $key => $value) {
            if (property_exists($beneficiarioFinal, $key)) {
                $beneficiarioFinal->$key = $value;
            }
        }

        return $beneficiarioFinal;
    }
}