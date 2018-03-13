<?php declare(strict_types=1);

namespace Tests\Builder\Entidade;

use Bling\Builder\Entidade\ItensBuilder;
use Bling\Builder\XmlHandler;
use PHPUnit\Framework\TestCase;
use Tests\Traits\EntityGeneratorTrait;

class ItensBuilderTest extends TestCase
{
    use EntityGeneratorTrait;

    public function testInitialization(): void
    {
        $builder = new ItensBuilder([$this->generateItem()]);

        $this->assertInstanceOf(ItensBuilder::class, $builder);
    }

    public function testXmlGeneration(): void
    {
        $xmlHandler = new XmlHandler();

        $item = $this->generateItem();
        $items = [
            sprintf('<codigo>%s</codigo>', $item->getCodigo()),
            sprintf('<descricao>%s</descricao>', $item->getDescricao()),
            sprintf('<un>%s</un>', $item->getUn()),
            sprintf('<qtde>%s</qtde>', $item->getQuantidade()),
            sprintf('<vlr_unit>%s</vlr_unit>', $item->getValorUnitario()),
            sprintf('<tipo>%s</tipo>', $item->getTipo()),
            sprintf('<peso_bruto>%s</peso_bruto>', $item->getPesoBruto()),
            sprintf('<peso_liq>%s</peso_liq>', $item->getPesoLiquido()),
            sprintf('<class_fiscal>%s</class_fiscal>', $item->getClassFiscal()),
            sprintf('<origem>%s</origem>', $item->getOrigem()),
        ];
        $itemXml = '<item>' . implode('', $items) . '</item>';
        $itemXml .= '<item>' . implode('', $items) . '</item>';
        $xml = '<itens>' . $itemXml . '</itens>';

        $builder = new ItensBuilder([$item, $item]);
        $xmlHandler->addChild($builder);

        $xmlResponse = $xmlHandler->handle();

        $this->assertInstanceOf(ItensBuilder::class, $builder);
        $this->assertContains($xml, $xmlResponse);
    }
}
