<?php declare(strict_types=1);

namespace Bling\NotaFiscal;

use Bling\NotaFiscal\Http\Client;
use function Bling\NotaFiscal\maskString;
use Bling\NotaFiscal\Entity\NotaFiscal;
use Bling\NotaFiscal\Entity\Pedido;
use Bling\NotaFiscal\Builder\XmlHandler;
use Bling\NotaFiscal\Builder\Entidade\PedidoBuilder;

class Bling
{
    private $strBlingUrl = "https://bling.com.br/Api/v2";

    public $strApiKey = "";

    private $apiKey;

    private $httpClient;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new Client($this->strBlingUrl);
    }

    /**
     * Consulta uma nota fiscal no ERP Bling
     *
     * @param string $numeroNota
     * @param string $serieNota
     * @return string (json|xml)
     */
        public function buscaNotaFiscal(
            ?string $numeroNota = null,
            ?string $serieNota = null
        ): NotaFiscal
        {
            $path = '';
            if ($numeroNota || $serieNota) {
            $path = $numeroNota . "/" . $serieNota;
        }
        return $this->sendToBling('notafiscal/' . $path);
    }

    public function enviaNotaFiscal(Pedido $pedido): NotaFiscal
    {
        $xmlHandler = new XmlHandler();
        $pedidoBuilder = new PedidoBuilder($pedido);
        $xmlHandler->addChild($pedidoBuilder);
        $xml = $xmlHandler->handle();

        return $this->sendToBling('notafiscal', 'post', ['xml' => rawurlencode($xml)]);
    }

    private function sendToBling(
        string $path,
        string $strAction = 'get',
        ?array $data = [],
        ?string $strResponseFormat = null,
        ?string $strItemCode = null
    ): NotaFiscal
    {
        $response = '';
        $client = $this->httpClient;
        if ($strAction == 'get') {
            //$path = sprintf('%s/%s/%s', $path, $data, $strResponseFormat);
            $response = $client->request($path, Client::METHOD_GET, ['apikey' => $this->apiKey]);
        } elseif($strAction == 'post') {
            $response = $client->request(
                $path,
                Client::METHOD_POST,
                array_merge($data, ['apikey' => $this->apiKey])
            );
        } elseif($strAction == 'delete') {
            $response = $client->request(
                $path,
                Client::METHOD_DELETE,
                ['apikey' => $this->apiKey]
            );
        }

        return $this->parseResponse($response);
    }

    private function parseResponse(string $response): NotaFiscal
    {
        $xml = simplexml_load_string($response, \SimpleXMLElement::class, LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json, true);

        if (isset($array['erros'])) {
            throw new \Exception($array['erros']['erro']['msg']);
        }

        $nota = $array['notasfiscais']['notafiscal'];
        $notaFiscal = new NotaFiscal(
            $nota['chaveacesso'],
            $nota['numero'],
            $nota['serie'],
            $nota['situacao'],
            $nota['xml'],
            $nota['linkdanfe']
        );

        return $notaFiscal;
    }
}
