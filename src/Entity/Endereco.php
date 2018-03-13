<?php declare(strict_types=1);

namespace Bling\Entity;

class Endereco
{
    private $endereco;

    private $numero;

    private $complemento;

    private $bairro;

    private $cep;

    private $cidade;

    private $uf;

    public function __construct(
        string $endereco,
        string $numero,
        string $complemento,
        string $bairro,
        string $cep,
        string $cidade,
        string $uf
    ) {
        $this->endereco = $endereco;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cep = $cep;
        $this->cidade = $cidade;
        $this->uf = $uf;
    }

    public function getEndereco(): string
    {
        return $this->endereco;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getComplemento(): string
    {
        return $this->complemento;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getUf(): string
    {
        return $this->uf;
    }
}
