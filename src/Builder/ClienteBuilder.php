<?php declare(strict_types=1);

namespace Bling\Builder;

use Bling\Entity\Cliente;
use Bling\Builder\XmlBuilderTrait;

class ClienteBuilder implements BuilderInterface
{
    use XmlBuilderTrait;

    private $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function build(\DOMDocument $xml): \DOMDocument
    {
        $clienteNode = $xml->createElement('cliente');

        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'nome',
            $this->cliente->getNome()
        );

        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'tipoPessoa',
            $this->cliente->getTipoPessoa()
        );

        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'cpf_cnpj',
            $this->cliente->getCpfCnpj()
        );

        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'fone',
            $this->cliente->getFone()
        );

        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'email',
            $this->cliente->getEmail()
        );

        $xml->appendChild($clienteNode);
        return $xml;
    }
}
