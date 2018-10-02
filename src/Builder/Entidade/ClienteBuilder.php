<?php declare(strict_types=1);

namespace Bling\NotaFiscal\Builder\Entidade;

use Bling\NotaFiscal\Entity\Cliente;
use Bling\NotaFiscal\Builder\XmlBuilderTrait;
use Bling\NotaFiscal\Builder\BuilderInterface;

class ClienteBuilder implements BuilderInterface
{
    use XmlBuilderTrait;

    private $cliente;

    private $endereco;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
        $this->endereco = $cliente->getEndereco();
    }

    public function build(\DOMDocument $xml): \DOMDocument
    {
        $clienteNode = $xml->createElement('cliente');

        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'nome',
            $this->sanitize($this->cliente->getNome())
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

        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'endereco',
            $this->sanitize($this->endereco->getEndereco())
        );

        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'numero',
            $this->sanitize($this->endereco->getNumero())
        );
        
        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'complemento',
            $this->sanitize($this->endereco->getComplemento())
        );
        
        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'bairro',
            $this->sanitize($this->endereco->getBairro())
        );
        
        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'cep',
            $this->endereco->getCep()
        );
        
        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'cidade',
            $this->sanitize($this->endereco->getCidade())
        );

        $clienteNode = $this->addXmlChild(
            $clienteNode,
            'uf',
            $this->endereco->getUf()
        );
        $xml->appendChild($clienteNode);
        return $xml;
    }
}
