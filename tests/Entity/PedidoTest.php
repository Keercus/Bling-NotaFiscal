<?php declare(strict_types=1);

namespace Tests\Entity;

use PHPUnit\Framework\TestCase;
use Bling\Entity\Cliente;
use Bling\Entity\Endereco;
use Bling\Entity\Item;
use Bling\Entity\Pedido;

class PedidoTest extends TestCase
{
    public function testInitialization(): void
    {
        $numeroNotaFiscal = '123';
        $cliente = $this->generateCliente();
        $itens = [$this->generateItems()];
        $valorDesconto = 0;
        $parcelas = [];
        $valorFrete = 0;
        $valorSeguro = 0;
        $valorDespesas = 0;
        $observacao = '';

        $pedido = new Pedido(
            $numeroNotaFiscal,
            $cliente,
            $itens,
            $valorDesconto,
            $parcelas,
            $valorFrete,
            $valorSeguro,
            $valorDespesas,
            $observacao
        );

        $this->assertInstanceOf(Pedido::class, $pedido);
        $this->assertEquals($numeroNotaFiscal, $pedido->getNumeroNotaFiscal());
        $this->assertInstanceOf(Cliente::class, $pedido->getCliente());
        $this->assertInternalType('array', $pedido->getItens());
        $this->assertEquals($valorDesconto, $pedido->getValorDesconto());
        $this->assertInternalType('array', $pedido->getParcelas());
        $this->assertEquals($valorFrete, $pedido->getValorFrete());
        $this->assertEquals($valorSeguro, $pedido->getValorSeguro());
        $this->assertEquals($valorDespesas, $pedido->getValorDespesas());
        $this->assertEquals($observacao, $pedido->getObservacao());
    }

    private function generateCliente(): Cliente
    {
        $nome = 'Teste';
        $tipoPessoa = Cliente::TIPO_FISICA;
        $cpfCnpj = '12345678911';
        $fone = '12345678';
        $email = 'teste@teste.com';
        $cliente = new Cliente(
            $nome,
            $tipoPessoa,
            $cpfCnpj,
            $fone,
            $email,
            $this->generateEndereco()
        );

        return $cliente;
    }

    private function generateEndereco(): Endereco
    {
        $endereco = 'Teste';
        $numero = '123';
        $complemento = 'Teste Complemento';
        $bairro = 'Teste Bairro';
        $cep = '12345789';
        $cidade = 'Teste Cidade';
        $uf = 'Ts';
        $enderecoObj = new Endereco(
            $endereco,
            $numero,
            $complemento,
            $bairro,
            $cep,
            $cidade,
            $uf
        );

        return $enderecoObj;
    }

    public function generateItems(): Item
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

        return $item;
    }
}
