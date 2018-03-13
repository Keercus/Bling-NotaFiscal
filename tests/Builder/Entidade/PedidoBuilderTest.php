<?php declare(strict_types=1);

namespace Tests\Builder\Entidade;

use Bling\Builder\Entidade\PedidoBuilder;
use Bling\Builder\XmlHandler;
use PHPUnit\Framework\TestCase;
use Tests\Traits\EntityGeneratorTrait;

class PedidoBuilderTest extends TestCase
{
    use EntityGeneratorTrait;

    public function testInitialization(): void
    {
        $builder = new PedidoBuilder($this->generatePedido());

        $this->assertInstanceOf(PedidoBuilder::class, $builder);
    }

    public function testXmlGeneration(): void
    {
        $xmlHandler = new XmlHandler();

        $pedido = $this->generatePedido();
        $item = [
            sprintf('<numero_nf>%s</numero_nf>', $pedido->getNumeroNotaFiscal()),
            sprintf('<vlr_frete>%s</vlr_frete>', $pedido->getValorFrete()),
            sprintf('<vlr_seguro>%s</vlr_seguro>', $pedido->getValorSeguro()),
            sprintf('<vlr_despesas>%s</vlr_despesas>', $pedido->getValorDespesas()),
            sprintf('<vlr_desconto>%s</vlr_desconto>', $pedido->getValorDesconto()),
        ];
        $obs = sprintf('<obs>%s</obs>', $pedido->getObservacao());
        if ('' == $pedido->getObservacao()) {
            $obs = '<obs/>';
        }
        $item[] = $obs;
        $xml = '<pedido>' . implode('', $item) . '</pedido>';

        $pedidoBuilder = new PedidoBuilder($pedido);
        $xmlHandler->addChild($pedidoBuilder);

        $xmlResponse = $xmlHandler->handle();

        $this->assertInstanceOf(PedidoBuilder::class, $pedidoBuilder);
        $this->assertContains($xml, $xmlResponse);
    }
}
