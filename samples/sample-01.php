<?php

require_once __DIR__ . '/../vendor/autoload.php';

// ppview_key: 'd9bc439b5ea518814c7ec271eb81c618868ad603'
$apiKey = 'bbd93972e542990e3bb6e47f04210706e7904f81d6cc91d2da2ea2a63d694ed237d4fcd3';
$bling = new Bling\NotaFiscal\Bling($apiKey);
$resp = $bling->buscaNotaFiscal('000001', '1');

var_dump($resp);
