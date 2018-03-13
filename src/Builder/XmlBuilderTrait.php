<?php declare(strict_types=1);

namespace Bling\Builder;

trait XmlBuilderTrait
{
    public function addXmlChild(\DOMElement $node, string $name, string $value = ''): \DOMElement
    {
        $child = new \DOMElement($name, $value);
        $node->appendChild($child);

        return $node;
    }
}
