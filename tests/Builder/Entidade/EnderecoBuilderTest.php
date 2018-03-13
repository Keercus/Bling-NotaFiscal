<?php declare(strict_types=1);

namespace Tests\Builder\Entidade;

use Bling\Builder\Entidade\EnderecoBuilder;
use Bling\Builder\XmlHandler;
use PHPUnit\Framework\TestCase;
use Tests\Traits\EntityGeneratorTrait;

class EnderecoBuilderTest extends TestCase
{
    use EntityGeneratorTrait;

    public function testInitialization(): void
    {
        $builder = new EnderecoBuilder($this->generateEndereco());

        $this->assertInstanceOf(EnderecoBuilder::class, $builder);
    }

    public function testXmlGeneration(): void
    {
        $xmlHandler = new XmlHandler();

        $endereco = $this->generateEndereco();
        $items = [
            sprintf('<endereco>%s</endereco>', $endereco->getEndereco()),
            sprintf('<numero>%s</numero>', $endereco->getNumero()),
            sprintf('<complemento>%s</complemento>', $endereco->getComplemento()),
            sprintf('<bairro>%s</bairro>', $endereco->getBairro()),
            sprintf('<cep>%s</cep>', $endereco->getCep()),
            sprintf('<cidade>%s</cidade>', $endereco->getCidade()),
            sprintf('<uf>%s</uf>', $endereco->getUf()),
        ];
        $xml = '<cliente>' . implode('', $items) . '</cliente>';
        $enderecoBuilder = new EnderecoBuilder($endereco);
        $xmlHandler->addChild($enderecoBuilder);

        $xmlResponse = $xmlHandler->handle();

        $this->assertInstanceOf(EnderecoBuilder::class, $enderecoBuilder);
        $this->assertContains($xml, $xmlResponse);
    }
}
