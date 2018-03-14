<?php declare(strict_types=1);

namespace Bling;

use Bling\NotaFiscal\Client;
use function Bling\NotaFiscal\maskString;

class Bling
{
    private $strBlingUrl = "https://bling.com.br/Api/v2";

    public $strApiKey = "";

    public function __construct(string $apiKey)
    {
        $this->strApiKey = $apiKey;
    }

    /**
     * Insere um produto no ERP Bling
     * Para inserir um produto ignore o parâmetro $strProductCode
     * Para atualizar um produto informe o parâmetro $strProductCode
     * 
     * @param array $arrayPreData
     * @param string $strProductCode
     * @return string
     */
    public function postProduct(array $arrayPreData, ?string $strProductCode = null) : string
    {
        // DEFINE O CONTEXTO DO ENVIO
        $strContext = 'produto';

        // SE HOUVER O PARÂMETRO LIMPA PONTUAÇÃO E CRIA MÁSCARA PARA O PARÂMETRO CLASSE FISCAL
        if (isset($arrayPreData['class_fiscal']) && !empty($arrayPreData['class_fiscal'])) {
            $arrayPreData['class_fiscal'] = str_replace('.', '', $arrayPreData['class_fiscal']);
            $arrayPreData['class_fiscal'] = maskString($arrayPreData['class_fiscal'], '####.##.##');
        }

        // DEFINE UM VALOR PADRÂO PARA O PARÂMETRO un CASO NÃO SEJA INFORMADO
        if (empty($arrayPreData['un']) || !isset($arrayPreData['un'])) {
            $arrayPreData['un'] = 'un';
        }

        // GERA A ARRAY PADRÃO PARA API 2 BLING
        $arrayData = array(
            "apikey" => $this->strApiKey,
            "xml" => rawurlencode($this->buildXml($arrayPreData, $strContext))
        );

        // EXECUTA O ENVIO DE DADOS PARA O BLING
        return $this->sendToBling($strContext, 'post', $arrayData, null, $strProductCode);
    }

    /**
     * Insere um pedido no ERP Bling
     *
     * @param array $arrayPreData
     * @param boolean $boolGerarNfe 
     * @return string
     */
    public function postOrder($arrayPreData, $boolGerarNfe = false) : string
    {
        // DEFINE O CONTEXTO DO ENVIO
        $strContext = 'pedido';

        // LIMPA CARACTERES DESNECESSÁRIOS NA STRING CNPJ
        if (isset($arrayPreData['cliente']['cnpj'])) {
            $arrayPreData['cliente']['cnpj'] = cleanDocument($arrayPreData['cliente']['cnpj']);
        }

        // LIMPA CARACTERES DESNECESSÁRIOS NA STRING PARA INSCRIÇÃO ESTADUAL
        if (isset($arrayPreData['cliente']['ie'])) {
            $arrayPreData['cliente']['ie'] = cleanDocument($arrayPreData['cliente']['ie']);
        }

        // LIMPA CARACTERES DESNECESSÁRIOS NA STRING RG
        if (isset($arrayPreData['cliente']['rg'])) {
            $arrayPreData['cliente']['rg'] = cleanDocument($arrayPreData['cliente']['rg']);
        }

        // LIMPA CARACTERES DESNECESSÁRIOS NA STRING CEP
        if (isset($arrayPreData['cliente']['cep']) && !empty($arrayPreData['cliente']['cep'])) {
            $arrayPreData['cliente']['cep'] = maskString($arrayPreData['cliente']['cep'], '##.###-###');
        }

        // PRÉ-DEFINE O PARÂMETRO ANTES DA ITERAÇÃO A SEGUIR
        $n = 0;

        // DEFINE UM VALOR PADRÂO EM CADA ITEM PARA O PARÂMETRO 'un' CASO NÃO SEJA INFORMADO 
        foreach ($arrayPreData['itens'] as $arrayValue) {
            if(isset($arrayValue['un']) && !$arrayValue['un']) {
                $arrayPreData['itens'][$n]['item']['un'] = 'un';
            }
            $n++;
        }

        // GERA A ARRAY PADRÃO PARA API 2 BLING
        $arrayData = array(
            "apikey" => $this->strApiKey,
            "xml" => rawurlencode($this->buildXml($arrayPreData, $strContext)),
            "gerarnfe" => $boolGerarNfe
        );

        // EXECUTA O ENVIO DE DADOS PARA O BLING
        return $this->sendDataToBling($strContext, 'post', $arrayData, null);
    }

    /**
     * Gera uma Nota Fiscal no ERP Bling
     *
     * @param array $arrayPreData
     * @return string | json
     */
    public function postNotaFiscal(array $arrayPreData) : array
    {
        // DEFINE O CONTEXTO DO ENVIO
        $strContext = 'notafiscal';

        // LIMPA CARACTERES DESNECESSÁRIOS NA STRING CNPJ PARA CLIENTE
        if (isset($arrayPreData['cliente']['cpf_cnpj'])) {
            $arrayPreData['cliente']['cpf_cnpj'] = cleanDocument($arrayPreData['cliente']['cpf_cnpj']);
        }

        // LIMPA CARACTERES DESNECESSÁRIOS NA STRING PARA INSCRIÇÃO ESTADUAL PARA CLIENTE
        if (isset($arrayPreData['cliente']['ie_rg'])) {
            $arrayPreData['cliente']['ie_rg'] = cleanDocument($arrayPreData['cliente']['ie_rg']);
        }

        // LIMPA CARACTERES DESNECESSÁRIOS NA STRING CEP PARA CLIENTE
        if (isset($arrayPreData['cliente']['cep'])) {
            $arrayPreData['cliente']['cep'] = maskString($arrayPreData['cliente']['cep'], '##.###-###');
        }

        // PRÉ-DEFINE O PARÂMETRO ANTES DA ITERAÇÃO A SEGUIR
        $n = 0;

        var_dump($arrayPreData);
        // DEFINE UM VALOR PADRÂO EM CADA ITEM PARA O PARÂMETRO 'un' CASO NÃO SEJA INFORMADO 
        foreach ($arrayPreData['itens'] as $arrayValue) {
            if (isset($arrayValue['un']) && !$arrayValue['un']) {
                $arrayPreData['itens'][$n]['item']['un'] = 'un';
            }

            // SE HOUVER O PARÂMETRO LIMPA PONTUAÇÃO E CRIA MÁSCARA PARA O PARÂMETRO CLASSE FISCAL
            if (isset($arrayValue['classe_fiscal']) && !empty($arrayValue['classe_fiscal'])) {
                $arrayValue['classe_fiscal'] = str_replace('.', '', $arrayValue['classe_fiscal']);
                $arrayPreData['itens'][$n]['item']['classe_fiscal'] = maskString($arrayValue['classe_fiscal'], '####.##.##');
            }
            $n++;
        }

        // LIMPA CARACTERES DESNECESSÁRIOS NA STRING CNPJ PARA TRANSPORTADORA
        if (isset($arrayPreData['transporte']['cpf_cnpj'])) {
            $arrayPreData['transporte']['cpf_cnpj'] = cleanDocument($arrayPreData['transporte']['cpf_cnpj']);
        }

        // LIMPA CARACTERES DESNECESSÁRIOS NA STRING PARA INSCRIÇÃO ESTADUAL PARA TRANSPORTADORA
        if (isset($arrayPreData['transporte']['ie_rg'])) {
            $arrayPreData['transporte']['ie_rg'] = cleanDocument($arrayPreData['transporte']['ie_rg']);
        }

        // LIMPA CARACTERES DESNECESSÁRIOS E CRIA  A MÁSCARA NA STRING CEP PARA DADOS DA ETIQUETA
        if (isset($arrayPreData['transporte']['dados_etiqueta']['cep']) && !empty($arrayPreData['transporte']['dados_etiqueta']['cep'])) {
            $arrayPreData['transporte']['dados_etiqueta']['cep'] = maskString($arrayPreData['transporte']['dados_etiqueta']['cep'], '##.###-###');
        }

        // GERA A ARRAY PADRÃO PARA API 2 BLING
        $arrayData = array(
            "apikey" => $this->strApiKey,
            "xml" => rawurlencode($this->buildXml($arrayPreData, $strContext))
        );

        return $arrayData;

        // EXECUTA O ENVIO DE DADOS PARA O BLING
        return $this->sendToBling($strContext, 'post', $arrayData, null);
    }

    /**
     * Consulta um produto no ERP Bling
     *
     * @param string $strProductCode
     * @param string $responseFormat (json|xml)
     * @return string
     */
    public function getProduct(string $strProductCode = null, string $responseFormat = 'xml') : string
    {
        // EXECUTA O ENVIO DE DADOS PARA O BLING
        return $this->sendToBling('produto', 'get', $strProductCode, $responseFormat);
    }

    /**
     * Consulta um pedido no ERP Bling
     *
     * @param string $strOrderCode
     * @param string $responseFormat (json|xml)
     * @return string (json|xml)
     */
    public function getOrder(string $strOrderCode = NULL, string $responseFormat = 'xml') : string
    {
        return $this->sendToBling('pedido', 'get', $strOrderCode, $responseFormat);
    }

    /**
     * Consulta uma nota fiscal no ERP Bling
     *
     * @param string $strNfNumber
     * @param string $strNfSerie
     * @param string $responseFormat (json|xml)
     * @return string (json|xml)
     */
    public function getNotaFiscal(
        ?string $strNfNumber = null,
        ?string $strNfSerie = null,
        string $responseFormat = 'xml'
    ) : string
    {
        $strNfCode = null;
        // PREPARA O PARÂMETRO PARA CONSULTA DE NOTA FISCAL (NOTA FISCAL + SERIE)
        if ($strNfNumber || $strNfSerie) {
            $strNfCode = $strNfNumber . "/" . $strNfSerie;
        }
        return $this->sendToBling('notafiscal', 'get', $strNfCode, $responseFormat);

    }

    /**
     * Deleta um produto no ERP Bling
     * 
     * @param string $strProductCode
     * @param string $responseFormat (json|xml)
     * @return string (json|xml)
     */
    public function deleteProduct(string $strProductCode, string $responseFormat = 'xml') : string
    {
        return $this->sendToBling('produto', 'delete', $strProductCode, $responseFormat);
    }

    private function sendToBling(
        string $path,
        string $strAction,
        ?string $data = null,
        ?string $strResponseFormat = null,
        ?string $strItemCode = null
    ) : string
    {
        $response = '';
        $client = new \Bling\NotaFiscal\Client($this->strBlingUrl); 
        if ($strAction == 'get') {
            $path = sprintf('%s/%s/%s', $path, $data, $strResponseFormat);
            $response = $client->request($path, Client::METHOD_GET, ['apikey' => $this->strApiKey]);
        } elseif($strAction == 'post') {
            $response = $client->request($path, Client::METHOD_POST, array_merge($arrayData, ['apikey' => $this->strApiKey]));
        } elseif($strAction == 'delete') {
            $path = sprintf('%s/%s/%s', $path, $data, $strResponseFormat);
            $response = $client->request($path, Client::METHOD_DELETE, ['apikey' => $this->strApiKey]);
        }

        return $response;
    }

    /**
    * Costroi o primeiro nível do XML 
    * 
    * @param array $array
    * @param string $context
    * @return string | xml
    */
    private function buildXml(array $array = [], string $context) : string
    {
        // DEFINE O PARÂMETRO PARA ENCODING
        $encoding = 'UTF8';

        // DEFINE O PARÂMETRO PARA O CONTEXTO DA REQUISIÇÃO
        $inicialTag = '<'.$context.' />';

        // CRIA O CABEÇALHO DO XML
        $xml = new \SimpleXMLElement("<?xml version='1.0' encoding='".$encoding."' ?>".$inicialTag);

        // ITERA CADA ELEMENTO DA ARRAY PARA CRIAÇÃO DOS NÓS DO XML
        foreach ($array as $key1 => $value1) {

            // SE O VALOR FOR UMA NOVA ARRAY OU OBJETO, CHAMA A FUNÇÃO PARA CRIAÇÃO DE NÓS
            // ABAIXO DO NÓ ATUAL
            if (is_array($value1) || is_object($value1)) {

                // CASO A CHAVE SEJA UM NÚMERO DA ARRAY DEFINE C NOVO NÓ COMO O NÓ PAI
                $newNode = $xml;
                // CASO A CHAVE NÃO SEJA UM NÚMERO DA ARRAY ADICIONA O NOVO NÓ
                if(!is_numeric($key1)) {
                    $newNode = $xml->addChild($key1);
                }
                // ADICIONA O NOVO NÓ FILHO
                $this->constructXmlNode($value1,$newNode);

            // CASO O VALOR EXISTA E SEJA UM STRING, CRIA UM UM NOVO NÓ NO XML, EXISTEM VALORES DEFINIDOS COMO "0"
            } elseif($value1 != "") {
                $xml->addChild($key1,  html_entity_decode((string)$value1));
            }
        }

        // RETORNA O XML
        return $xml->asXML();
    }

    /**
    * Transforma arrays em XML a nível infinito
    *
    * @param array $array
    * @param object $node
    */
    private function constructXmlNode(array $array, $node)
    {
        // ITERA CADA ITEM DA ARRAY RECEBIDA
        foreach ($array as $key => $value) {

            // SE O VALOR FOR UMA NOVA ARRAY OU OBJETO, CHAMA A FUNÇÃO PARA CRIAÇÃO DE NÓS
            // ABAIXO DO NÓ ATUAL
            if (is_array($value) || is_object($value)) {

                // CASO A CHAVE SEJA UM NÚMERO DA ARRAY DEFINE C NOVO NÓ COMO O NÓ PAI
                $newNode = $node;
                // CASO A CHAVE NÃO SEJA UM NÚMERO DA ARRAY ADICIONA O NOVO NÓ
                if (!is_numeric($key)) {
                    $newNode = $node->addChild($key);
                }
                // INICIA A CONSTRUÇÃO DE UM NOVO NÓ FILHO
                $this->constructXmlNode($value,$newNode);

            // CASO O VALOR EXISTA E SEJA UM STRING, CRIA UM UM NOVO NÓ NO XML, EXISTEM VALORES DEFINIDOS COMO "0"
            } elseif($value != "") {
                $node->addChild($key, htmlspecialchars((string)$value));
            }
        }
    }
}
