<?php declare(strict_types=1);

namespace Bling\NotaFiscal\Builder\Entidade;

use Bling\NotaFiscal\Entity\Endereco;
use Bling\NotaFiscal\Builder\XmlBuilderTrait;
use Bling\NotaFiscal\Builder\BuilderInterface;

class EnderecoBuilder implements BuilderInterface
{
    use XmlBuilderTrait;

    private $endereco;

    public function __construct(Endereco $endereco)
    {
        $this->endereco = $endereco;
    }

    public function build(\DOMDocument $xml): \DOMDocument
    {
        $enderecoNode = $xml->getElementsByTagName('cliente')[0];
        if (!$enderecoNode) {
            $enderecoNode = $xml->createElement('cliente');
        }

        $enderecoNode = $this->addXmlChild(
            $enderecoNode,
            'endereco',
            $this->endereco->getEndereco()
        );

        $enderecoNode = $this->addXmlChild(
            $enderecoNode,
            'numero',
            $this->endereco->getNumero()
        );
        
        $enderecoNode = $this->addXmlChild(
            $enderecoNode,
            'complemento',
            $this->endereco->getComplemento()
        );
        
        $enderecoNode = $this->addXmlChild(
            $enderecoNode,
            'bairro',
            $this->endereco->getBairro()
        );
        
        $enderecoNode = $this->addXmlChild(
            $enderecoNode,
            'cep',
            $this->endereco->getCep()
        );
        
        $enderecoNode = $this->addXmlChild(
            $enderecoNode,
            'cidade',
            $this->endereco->getCidade()
        );

        $enderecoNode = $this->addXmlChild(
            $enderecoNode,
            'uf',
            $this->endereco->getUf()
        );

        $xml->appendChild($enderecoNode);
        return $xml;
    }
}
