<?php declare(strict_types=1);

namespace Tests\Entity;

use PHPUnit\Framework\TestCase;
use Bling\NotaFiscal\Entity\Parcela;

class ParcelaTest extends TestCase
{
    public function testInitialization(): void
    {
        $dias = 1;
        $data = date('d/m/Y');
        $valor = 10.00;
        $observacao = '-';
        $formaPagamento = '';

        $parcela = new Parcela(
            $data,
            $valor,
            $dias,
            $observacao,
            $formaPagamento
        );

        $this->assertInstanceOf(Parcela::class, $parcela);
        $this->assertEquals($data, $parcela->getData());
        $this->assertEquals($valor, $parcela->getValor());
        $this->assertEquals($dias, $parcela->getDias());
        $this->assertEquals($observacao, $parcela->getObservacao());
        $this->assertEquals($formaPagamento, $parcela->getFormaPagamento());
    }
}
