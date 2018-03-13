<?php

require_once __DIR__ . '/../vendor/autoload.php';

$bling = new Bling\Bling('TEST');

$data = [
    //'pedido' => [
        'numero_nf' => '123',
        'cliente' => [
            'nome' => 'Test Name',
            'tipoPessoa' => 'J',
            'cnpj' => '46.618.811/0001-51',
            'ie' => 'Isento',
            'cep' => '03245000',
            'endereco' => 'Rua Bla',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Teste',
            'cep' => '03244030',
            'cidade' => 'Sao Paulo',
            'uf' => 'SP',
            'fone' => '11 11111111',
            'email' => 'teste@teste.com'
        ],
        'itens' => [
            'item' => [
                'codigo' => '123', // sku
                'descricao' => 'Teste 123',
                'un' => 'Un',
                'qtde' => 1,
                'vlr_unit' => 10,
                'peso_bruto' => 10.20,
                'peso_liq' => 10.20,
                'class_fiscal' => '1233',
                'origem' => 0
            ]
        ],
        'parcelas' => [
            'parcela' => [
                'dias' => 1,
                'data' => date('d/m/Y'),
                'vlr' => 10.10, // total
                'obs' => '-'
            ]
        ],
        'vlr_frete' => '0', // check config enviar frete
        'vlr_seguro' => '0',
        'vlr_despesas' => '0',
        'vlr_desconto' => 1.20,
        'obs' => 'Teste'
    //]
];


$resp = $bling->postNotaFiscal($data);
var_dump(rawurldecode($resp['xml']));
