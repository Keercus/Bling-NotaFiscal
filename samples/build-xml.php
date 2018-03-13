<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Bling\Entity\Cliente;
use Bling\Entity\Endereco;
use Bling\Entity\Item;
use Bling\Entity\Pedido;
use Bling\Builder\XmlHandler;
use Bling\Builder\Entidade\PedidoBuilder;

$endereco = new Endereco(
    'Rua bla',
    '123',
    'complemento',
    'Vila Bla',
    '01000-000',
    'Sao Paulo',
    'SP'
);
$cliente = new Cliente(
    'Teste',
    Cliente::TIPO_FISICA,
    '12345678988',
    '12345678',
    'teste@teste.com',
    $endereco
);

$item = new Item(
    '123',
    'Teste Produto',
    10.10,
    1.345,
    1.345,
    '4820.100',
    1,
    '0',
    'un',
    Item::TIPO_PRODUTO
);

$pedido = new Pedido(
    '123',
    $cliente,
    [$item],
    0,
    [],
    0,
    0,
    0,
    ''
);

$xmlHandler = new XmlHandler();
$pedidoBuilder = new PedidoBuilder($pedido);
$xmlHandler->addChild($pedidoBuilder);
$xmlResponse = $xmlHandler->handle();


echo($xmlResponse);
