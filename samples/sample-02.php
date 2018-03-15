<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Bling\NotaFiscal\Entity\Cliente;
use Bling\NotaFiscal\Entity\Endereco;
use Bling\NotaFiscal\Entity\Item;
use Bling\NotaFiscal\Entity\Pedido;

function generateCliente(): Cliente
{
    return new Cliente(
        'Teste',
        Cliente::TIPO_FISICA,
        '12345678911',
        '12345678',
        'teste@teste.com',
        generateEndereco()
    );
}

function generateEndereco(): Endereco
{
    return new Endereco('Teste', '123', 'Teste Complemento', 'Teste Bairro', '12345789', 'Teste Cidade', 'TS');
}

function generateItem(): Item
{
    return new Item('123', 'Nome do produto', 10.00, 1.123, 1.123, '4820.1000', 1, '0', 'un', Item::TIPO_PRODUTO);
}

function generatePedido(): Pedido
{
    return new Pedido('002', generateCliente(), [generateItem()], 0, [], 0, 0, 0, '');
}


$apiKey = 'bbd93972e542990e3bb6e47f04210706e7904f81d6cc91d2da2ea2a63d694ed237d4fcd3';
$bling = new Bling\NotaFiscal\Bling($apiKey);

$response = $bling->enviaNotaFiscal(generatePedido());

var_dump($response);
