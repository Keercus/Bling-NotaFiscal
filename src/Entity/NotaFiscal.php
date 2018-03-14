<?php declare(strict_types=1);

namespace Bling\NotaFiscal\Entity;

class NotaFiscal
{
    private $chaveAcesso;

    private $xmlLink;

    private $danfeLink;

    private $numero;

    private $serie;

    public function __construct(
        string $chaveAcesso,
        string $numero,
        string $serie,
        string $xmlLink,
        string $danfeLink
    ) {
        $this->chaveAcesso = $chaveAcesso;
        $this->numero = $numero;
        $this->serie = $serie;
        $this->xmlLink = $xmlLink;
        $this->danfeLink = $danfeLink;
    }

    public function getChaveAcesso(): string
    {
        return $this->chaveAcesso;
    }

    public function getXmlLink(): string
    {
        return $this->xmlLink;
    }

    public function getDanfeLink(): string
    {
        return $this->danfeLink;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getSerie(): string
    {
        return $this->serie;
    }
}
