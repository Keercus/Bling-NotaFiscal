<?php declare(strict_types=1);

namespace Tests\Entity;

use Bling\NotaFiscal\Entity\NotaFiscal;
use PHPUnit\Framework\TestCase;

class NotaFiscalTest extends TestCase
{
    public function testInitializationObject(): void
    {
        $chaveAcesso = '1234567898';
        $xmlLink = 'http://xml.link';
        $danfeLink = 'http://danfe.link';
        $numero = '1';
        $serie = '1';

        $nota = new NotaFiscal(
            $chaveAcesso,
            $numero,
            $serie,
            $xmlLink,
            $danfeLink
        );

        $this->assertInstanceOf(NotaFiscal::class, $nota);
        $this->assertEquals($chaveAcesso, $nota->getChaveAcesso());
        $this->assertEquals($numero, $nota->getNumero());
        $this->assertEquals($serie, $nota->getSerie());
        $this->assertEquals($xmlLink, $nota->getXmlLink());
        $this->assertEquals($danfeLink, $nota->getDanfeLink());
    }
}
