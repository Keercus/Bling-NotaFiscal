<?php declare(strict_types=1);

namespace Bling\NotaFiscal\Builder;

trait XmlBuilderTrait
{
    public function addXmlChild(\DOMElement $node, string $name, string $value = ''): \DOMElement
    {
        $child = new \DOMElement($name, $value);
        $node->appendChild($child);

        return $node;
    }

    public function sanitize($string): string
    {
        return str_replace(
            ['&', '<', '>', '\'', '"'], 
            ['&amp;', '&lt;', '&gt;', '&apos;', '&quot;'],
            $string
        );
    }
}
