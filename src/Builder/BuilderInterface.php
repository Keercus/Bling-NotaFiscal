<?php declare(strict_types=1);

namespace Bling\Builder;

interface BuilderInterface
{
    public function build(\DomDocument $xml): string;
}
