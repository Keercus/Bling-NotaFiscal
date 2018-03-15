<?php

require_once __DIR__ . '/../vendor/autoload.php';

$bling = new Bling\NotaFiscal\Bling('d9bc439b5ea518814c7ec271eb81c618868ad603');
$resp = $bling->buscaNotaFiscal('18099', '001');

var_dump($resp);
