<?php declare(strict_types=1);

namespace Bling\Entity;

class Cliente
{
    const TIPO_FISICA = 'F';

    const TIPO_JURIDICA = 'J';

    private $nome;

    private $tipoPessoa;

    private $cpfCnpj;

    private $fone;

    private $email;

    private $endereco;

    public function __construct(
        string $nome,
        string $tipoPessoa,
        string $cpfCnpj,
        string $fone,
        string $email,
        Endereco $endereco
    ) {
        $this->nome = $nome;
        $this->tipoPessoa = $tipoPessoa;
        $this->cpfCnpj = $cpfCnpj;
        $this->fone = $fone;
        $this->email = $email;
        $this->endereco = $endereco;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getTipoPessoa(): string
    {
        return $this->tipoPessoa;
    }

    public function getCpfCnpj(): string
    {
        return $this->cpfCnpj;
    }

    public function getFone(): string
    {
        return $this->fone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEndereco(): Endereco
    {
        return $this->endereco;
    }
}
