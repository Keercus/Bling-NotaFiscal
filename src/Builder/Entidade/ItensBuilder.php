<?php declare(strict_types=1);

namespace Bling\NotaFiscal\Builder\Entidade;

use Bling\NotaFiscal\Entity\Itens;
use Bling\NotaFiscal\Builder\XmlBuilderTrait;
use Bling\NotaFiscal\Builder\BuilderInterface;
use Bling\NotaFiscal\Entity\Item;

class ItensBuilder implements BuilderInterface
{
    use XmlBuilderTrait;

    private $itens;

    public function __construct(array $itens)
    {
        $this->itens = $itens;
    }

    public function build(\DOMDocument $xml): \DOMDocument
    {
        $itensNode = $xml->createElement('itens');

        foreach ($this->itens as $item) {
            $itemNode = $this->buildItem($xml, $item);
            $itensNode->appendChild($itemNode);
        }
        
        $xml->appendChild($itensNode);
        return $xml;
    }

    private function buildItem(\DOMDocument $xml, Item $item): \DOMElement
    {
        $itemNode = $xml->createElement('item');
        $itemNode = $this->addXmlChild(
            $itemNode,
            'codigo',
            $item->getCodigo()
        );

        $itemNode = $this->addXmlChild(
            $itemNode,
            'descricao',
            $item->getDescricao()
        );

        $itemNode = $this->addXmlChild(
            $itemNode,
            'un',
            $item->getUn()
        );

        $itemNode = $this->addXmlChild(
            $itemNode,
            'qtde',
            (string)$item->getQuantidade()
        );

        $itemNode = $this->addXmlChild(
            $itemNode,
            'vlr_unit',
            (string)$item->getValorUnitario()
        );

        $itemNode = $this->addXmlChild(
            $itemNode,
            'tipo',
            $item->getTipo()
        );

        $itemNode = $this->addXmlChild(
            $itemNode,
            'peso_bruto',
            (string)$item->getPesoBruto()
        );

        $itemNode = $this->addXmlChild(
            $itemNode,
            'peso_liq',
            (string)$item->getPesoLiquido()
        );

        $itemNode = $this->addXmlChild(
            $itemNode,
            'class_fiscal',
            $item->getClassFiscal()
        );

        $itemNode = $this->addXmlChild(
            $itemNode,
            'origem',
            $item->getOrigem()
        );

        return $itemNode;
    }
}
