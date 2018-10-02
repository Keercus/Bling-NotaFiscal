<?php declare(strict_types=1);

namespace Tests\Builder\Entidade;

use Bling\NotaFiscal\Builder\Entidade\ClienteBuilder;
use Bling\NotaFiscal\Builder\XmlHandler;
use PHPUnit\Framework\TestCase;
use Tests\Traits\EntityGeneratorTrait;

class ClienteBuilderTest extends TestCase
{
    use EntityGeneratorTrait;

    public function testInitialization(): void
    {
        $builder = new ClienteBuilder($this->generateCliente());

        $this->assertInstanceOf(ClienteBuilder::class, $builder);
    }

    public function testXmlGeneration(): void
    {
        $xmlHandler = new XmlHandler();

        $cliente = $this->generateCliente();
        $items = [
            sprintf('<nome>%s</nome>', $cliente->getNome()),
            sprintf('<tipoPessoa>%s</tipoPessoa>', $cliente->getTipoPessoa()),
            sprintf('<cpf_cnpj>%s</cpf_cnpj>', $cliente->getCpfCnpj()),
            sprintf('<fone>%s</fone>', $cliente->getFone()),
            sprintf('<email>%s</email>', $cliente->getEmail()),
            sprintf('<endereco>%s</endereco>', $cliente->getEndereco()->getEndereco()),
            sprintf('<numero>%s</numero>', $cliente->getEndereco()->getNumero()),
            sprintf('<complemento>%s</complemento>', $cliente->getEndereco()->getComplemento()),
            sprintf('<bairro>%s</bairro>', $cliente->getEndereco()->getBairro()),
            sprintf('<cep>%s</cep>', $cliente->getEndereco()->getCep()),
            sprintf('<cidade>%s</cidade>', $cliente->getEndereco()->getCidade()),
            sprintf('<uf>%s</uf>', $cliente->getEndereco()->getUf())
        ];
        $xml = '<cliente>' . implode('', $items) . '</cliente>';

        $clientBuilder = new ClienteBuilder($cliente);
        $xmlHandler->addChild($clientBuilder);

        $xmlResponse = $xmlHandler->handle();

        $this->assertInstanceOf(ClienteBuilder::class, $clientBuilder);
        $this->assertContains($xml, $xmlResponse);
    }
}
