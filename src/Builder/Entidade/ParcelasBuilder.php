<?php declare(strict_types=1);

namespace Bling\Builder\Entidade;

use Bling\Entity\Parcela;
use Bling\Builder\XmlBuilderTrait;
use Bling\Builder\BuilderInterface;

class ParcelasBuilder implements BuilderInterface
{
    use XmlBuilderTrait;

    private $parcelas;

    public function __construct(array $parcelas)
    {
        $this->parcelas = $parcelas;
    }

    public function build(\DOMDocument $xml): \DOMDocument
    {
        $parcelasNode = $xml->createElement('parcelas');

        foreach ($this->parcelas as $parcela) {
            $parcelaNode = $this->buildItem($xml, $parcela);
            $parcelasNode->appendChild($parcelaNode);
        }

        $xml->appendChild($parcelasNode);
        return $xml;
    }

    public function buildItem(\DOMDocument $xml, Parcela $parcela): \DOMElement
    {
        $parcelaNode = $xml->createElement('parcela');
        $parcelaNode = $this->addXmlChild(
            $parcelaNode,
            'dias',
            (string)$parcela->getDias()
        );
        $parcelaNode = $this->addXmlChild(
            $parcelaNode,
            'data',
            $parcela->getData()
        );
        $parcelaNode = $this->addXmlChild(
            $parcelaNode,
            'vlr',
            (string)$parcela->getValor()
        );
        $parcelaNode = $this->addXmlChild(
            $parcelaNode,
            'obs',
            $parcela->getObservacao()
        );
        $parcelaNode = $this->addXmlChild(
            $parcelaNode,
            'forma',
            (string)$parcela->getFormaPagamento()
        );

        return $parcelaNode;
    }

}
