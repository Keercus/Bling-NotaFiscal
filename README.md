Bling Nota Fiscal
===========================

Biblioteca se propóe à comunicar com o Bling ERP para envio de produtos e geração notas fiscais.

# Documentação Bling

Para acessar, basca clicar [aqui](https://manuais.bling.com.br/api/?item=notas-fiscais)

# Exemplo

## Buscar dados da nota Fiscal

```php
require __DIR__ . '/vendor/autoload.php';

$bling = new \Bling\NotaFiscal\Bling('sua-api-key');
$nota = $bling->buscaNotaFiscal('numero-nota', 'serie'); // Retorna NotaFiscal()

echo $nota->getChaveAcesso();
```

## Enviar dados de nota fiscal

```php
require_once __DIR__ . '/vendor/autoload.php';

use Bling\NotaFiscal\Entity\Cliente;
use Bling\NotaFiscal\Entity\Endereco;
use Bling\NotaFiscal\Entity\Item;
use Bling\NotaFiscal\Entity\Pedido;

function generateCliente(): Cliente
{
    return new Cliente(
        'Teste',
        Cliente::TIPO_FISICA,
        '12345678911',
        '12345678',
        'teste@teste.com',
        generateEndereco()
    );
}

function generateEndereco(): Endereco
{
    return new Endereco('Teste', '123', 'Teste Complemento', 'Teste Bairro', '12345789', 'Teste Cidade', 'TS');
}

function generateItem(): Item
{
    return new Item('123', 'Nome do produto', 10.00, 1.123, 1.123, '4820.1000', 1, '0', 'un', Item::TIPO_PRODUTO);
}

function generatePedido(): Pedido
{
    return new Pedido('002', generateCliente(), [generateItem()], 0, [], 0, 0, 0, '');
}


$apiKey = 'sua-api-key';
$bling = new Bling\NotaFiscal\Bling($apiKey);

$response = $bling->enviaNotaFiscal(generatePedido());

var_dump($response);
```

## Transmite uma nota Fiscal

```php
require __DIR__ . '/vendor/autoload.php';

$bling = new \Bling\NotaFiscal\Bling('sua-api-key');
$nota = $bling->transmiteNotaFiscal('numero-nota', 'serie', 'enviar-email (true|false)');

var_dump($response);
```

## Objeto NotaFiscal

Ao enviar uma nova nota ou buscar uma nota qualquer, será retornado uma Entidade `NotaFiscal` com as seguintes informações

* Chave de Acesso
* Link do XML
* Link do Danfe
* Número da Nota
* Série
* Situação
