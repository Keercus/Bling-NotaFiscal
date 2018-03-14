<?php

require_once __DIR__ . '/../vendor/autoload.php';

$bling = new Bling\NotaFiscal\Bling('d9bc439b5ea518814c7ec271eb81c618868ad603');
$resp = $bling->getNotaFiscal('18099', '001');


file_put_contents('notafiscal.txt', serialize($resp));
