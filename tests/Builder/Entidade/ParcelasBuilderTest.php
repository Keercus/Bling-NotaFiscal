<?php declare(strict_types=1);

namespace Tests\Builder\Entidade;

use Bling\Builder\Entidade\ParcelasBuilder;
use Bling\Builder\XmlHandler;
use PHPUnit\Framework\TestCase;
use Tests\Traits\EntityGeneratorTrait;

class ParcelaBuilderTest extends TestCase
{
    use EntityGeneratorTrait;

    public function testInitialization(): void
    {
        $builder = new ParcelasBuilder([$this->generateParcela()]);

        $this->assertInstanceOf(ParcelasBuilder::class, $builder);
    }

    public function testXmlGeneration(): void
    {
        $xmlHandler = new XmlHandler();

        $parcela = $this->generateParcela();
        $items = [
            sprintf('<dias>%s</dias>', $parcela->getDias()),
            sprintf('<data>%s</data>', $parcela->getData()),
            sprintf('<vlr>%s</vlr>', $parcela->getValor()),
            sprintf('<obs>%s</obs>', $parcela->getObservacao()),
        ];
        $forma = sprintf('<forma>%s</forma>', $parcela->getFormaPagamento());
        if ('' == $parcela->getFormaPagamento()) {
            $forma = '<forma/>';
        }
        $items[] = $forma;
        $itemXml = '<parcela>' . implode('', $items) . '</parcela>';

        $xml = '<parcelas>' . $itemXml . '</parcelas>';

        $builder = new ParcelasBuilder([$parcela]);
        $xmlHandler->addChild($builder);

        $xmlResponse = $xmlHandler->handle();

        $this->assertInstanceOf(ParcelasBuilder::class, $builder);
        $this->assertContains($xml, $xmlResponse);
    }
}
