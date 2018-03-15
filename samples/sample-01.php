<?php

require_once __DIR__ . '/../vendor/autoload.php';

$apiKey = 'bbd93972-1s3-e542990-2s4-e3bb6e47f042-3s5-10706e7904-4s6-f81d6cc91d2da2ea2a63d694ed237d4fcd3';
$bling = new Bling\NotaFiscal\Bling($apiKey);
$resp = $bling->buscaNotaFiscal('000001', '1');

var_dump($resp);
