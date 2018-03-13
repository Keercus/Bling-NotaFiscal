<?php declare(strict_types=1);

namespace Bling\Builder;

class XmlHandler
{
    protected $xml;

    protected $elements;

    public function __construct()
    {
        $this->xml = new \DomDocument('1.0');
        $this->xml->preventWhiteSpace = true;
    }

    public function addChild(BuilderInterface $builder): self
    {
        $this->elements[] = $builder;
        return $this;
    }


    public function handle(): string
    {
        $response = '';
        foreach ($this->elements as $element) {
            $response = $element->build($this->xml);
        }

        return $response;
    }
}
