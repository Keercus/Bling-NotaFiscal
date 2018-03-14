<?php declare(strict_types=1);

namespace Bling\NotaFiscal\Builder;

interface BuilderInterface
{
    public function build(\DOMDocument $xml): \DOMDocument;
}
