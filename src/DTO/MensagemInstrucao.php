<?php

namespace Logics\SicoobSdk\DTO;

use Logics\SicoobSdk\Enum\TipoInstrucao;

final class MensagemInstrucao
{
    private TipoInstrucao $tipoInstrucao;

    private array $mensagens;

    public function getTipoInstrucao(): TipoInstrucao
    {
        return $this->tipoInstrucao;
    }

    public function setTipoInstrucao(TipoInstrucao $tipoInstrucao): self
    {
        $this->tipoInstrucao = $tipoInstrucao;

        return $this;
    }

    public function getMensagens(): array
    {
        return $this->mensagens;
    }

    public function setMensagens(array $mensagens): self
    {
        $this->mensagens = $mensagens;

        return $this;
    }

    public static function createFromJsonArray($data): MensagemInstrucao
    {
        $mensagemInstrucao = new MensagemInstrucao();

        foreach ($data as $key => $value) {
            if (property_exists($mensagemInstrucao, $key)) {
                $mensagemInstrucao->$key = self::convertValueByKey($key, $value);
            }
        }

        return $mensagemInstrucao;
    }

    private static function convertValueByKey(string $key, mixed $value): mixed
    {
        return match ($key) {
            'tipoInstrucao' => TipoInstrucao::get($value),
            default => $value,
        };
    }
}