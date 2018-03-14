<?php declare(strict_types=1);

namespace Bling\NotaFiscal\Builder\Entidade;

use Bling\NotaFiscal\Entity\Pedido;
use Bling\NotaFiscal\Builder\XmlBuilderTrait;
use Bling\NotaFiscal\Builder\BuilderInterface;
use Bling\NotaFiscal\Builder\Entidade\ClienteBuilder;
use Bling\NotaFiscal\Builder\Entidade\ItensBuilder;
use Bling\NotaFiscal\Builder\Entidade\ParcelasBuilder;

class PedidoBuilder implements BuilderInterface
{
    use XmlBuilderTrait;

    private $pedido;

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    public function build(\DOMDocument $xml): \DOMDocument
    {
        $pedidoNode = $xml->createElement('pedido');
        $pedidoNode = $this->addXmlChild(
            $pedidoNode,
            'numero_nf',
            $this->pedido->getNumeroNotaFiscal()
        );
        $pedidoNode = $this->addXmlChild(
            $pedidoNode,
            'vlr_frete',
            (string)$this->pedido->getValorFrete()
        );
        $pedidoNode = $this->addXmlChild(
            $pedidoNode,
            'vlr_seguro',
            (string)$this->pedido->getValorSeguro()
        );
        $pedidoNode = $this->addXmlChild(
            $pedidoNode,
            'vlr_despesas',
            (string)$this->pedido->getValorDespesas()
        );
        $pedidoNode = $this->addXmlChild(
            $pedidoNode,
            'vlr_desconto',
            (string)$this->pedido->getValorDesconto()
        );
        $pedidoNode = $this->addXmlChild(
            $pedidoNode,
            'obs',
            $this->pedido->getObservacao()
        );
        $pedidoNode->appendChild($this->buildCliente($xml)->getElementsByTagName('cliente')[0]);
        $pedidoNode->appendChild($this->buildItens($xml)->getElementsByTagName('itens')[0]);
        $pedidoNode->appendChild($this->buildParcelas($xml)->getElementsByTagName('parcelas')[0]);
        $xml->appendChild($pedidoNode);
        return $xml;
    }

    private function buildCliente(\DOMDocument $xml): \DOMDocument
    {
        $builder = new ClienteBuilder($this->pedido->getCliente());
        return $builder->build($xml);
    }

    private function buildItens(\DOMDocument $xml): \DOMDocument
    {
        $builder = new ItensBuilder($this->pedido->getItens());
        return $builder->build($xml);
    }

    private function buildParcelas(\DOMDocument $xml): \DOMDocument
    {
        $builder = new ParcelasBuilder($this->pedido->getParcelas());
        return $builder->build($xml);
    }
}
