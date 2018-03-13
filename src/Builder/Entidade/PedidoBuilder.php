<?php declare(strict_types=1);

namespace Bling\Builder\Entidade;

use Bling\Entity\Pedido;
use Bling\Builder\XmlBuilderTrait;
use Bling\Builder\BuilderInterface;

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
        $xml->appendChild($pedidoNode);
        return $xml;
    }

}
