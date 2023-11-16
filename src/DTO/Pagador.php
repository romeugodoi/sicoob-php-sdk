<?php

namespace Logics\SicoobSdk\DTO;

final class Pagador
{
    private string $numeroCpfCnpj;

    private string $nome;

    private string $endereco;

    private string $bairro;

    private string $cidade;

    private int $cep;

    private string $uf;

    /**
     * @var string[]
     */
    private array $email;

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

    public function getEndereco(): string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function setBairro(string $bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getCep(): int
    {
        return $this->cep;
    }

    public function setCep(int $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getUf(): string
    {
        return $this->uf;
    }

    public function setUf(string $uf): self
    {
        $this->uf = $uf;

        return $this;
    }

    public function getEmail(): array
    {
        return $this->email;
    }

    public function setEmail(array $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function addEmail(string $email): void
    {
        $this->email[] = $email;
    }

    public static function createFromJsonArray($data): Pagador
    {
        $pagador = new Pagador();

        foreach ($data as $key => $value) {
            if (property_exists($pagador, $key)) {
                $pagador->$key = $value;
            }
        }

        return $pagador;
    }

    public function toArray(): array
    {
        return [
            'numeroCpfCnpj' => $this->getNumeroCpfCnpj(),
            'nome' => $this->getNome(),
            'endereco' => $this->getEndereco(),
            'bairro' => $this->getBairro(),
            'cidade' => $this->getCidade(),
            'cep' => strval($this->getCep()),
            'uf' => $this->getUf(),
            'email' => $this->getEmail(),
        ];
    }
}