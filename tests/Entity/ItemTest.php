<?php declare(strict_types=1);

namespace Tests\Entity;

use PHPUnit\Framework\TestCase;
use Bling\Entity\Item;

class ItemTest extends TestCase
{
    public function testInitializationObject(): void
    {
        $codigo = '123';
        $descricao = 'Nome Produto';
        $un = 'un';
        $quantidade = 1;
        $valorUnitario = 10.00;
        $tipo = Item::TIPO_PRODUTO;
        $pesoBruto = 1.5000;
        $pesoLiquido = 1.5000;
        $classFiscal = '4820.1000';
        $origem = '0';

        $item = new Item(
            $codigo,
            $descricao,
            $valorUnitario,
            $pesoBruto,
            $pesoLiquido,
            $classFiscal,
            $quantidade,
            $origem,
            $un,
            $tipo
        );

        $this->assertInstanceOf(Item::class, $item);
        $this->assertEquals($codigo, $item->getCodigo());
        $this->assertEquals($descricao, $item->getDescricao());
        $this->assertEquals($valorUnitario, $item->getValorUnitario());
        $this->assertEquals($pesoBruto, $item->getPesoBruto());
        $this->assertEquals($pesoLiquido, $item->getPesoLiquido());
        $this->assertEquals($classFiscal, $item->getClassFiscal());
        $this->assertEquals($quantidade, $item->getQuantidade());
        $this->assertEquals($origem, $item->getOrigem());
        $this->assertEquals($un, $item->getUn());
        $this->assertEquals($tipo, $item->getTipo());
    }
}
