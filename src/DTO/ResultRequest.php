<?php

namespace Logics\SicoobSdk\DTO;

class ResultRequest
{
    private string $codigo;

    private string $mensagem;

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function getMensagem(): string
    {
        return $this->mensagem;
    }

    public function setCodigo(string $codigo): ResultRequest
    {
        $this->codigo = $codigo;
        return $this;
    }

    public function setMensagem(string $mensagem): ResultRequest
    {
        $this->mensagem = $mensagem;
        return $this;
    }

    public static function createFromJsonArray($data): ResultRequest
    {
        $result = new ResultRequest();

        foreach ($data as $key => $value) {
            if (property_exists($result, $key)) {
                $result->$key = $value;
            }
        }

        return $result;
    }
}