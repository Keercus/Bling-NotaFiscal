<?php declare(strict_types=1);

namespace Tests\Traits;

use Bling\Entity\Cliente;
use Bling\Entity\Endereco;
use Bling\Entity\Item;
use Bling\Entity\Pedido;

trait EntityGeneratorTrait
{
    public function generateCliente(): Cliente
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

    public function generateEndereco(): Endereco
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

    public function generatePedido(): Pedido
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

        return $pedido;
    }
}
