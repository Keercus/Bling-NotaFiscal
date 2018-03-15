Bling Nota Fiscal
===========================

Biblioteca se propóe à comunicar com o Bling ERP para envio de produtos e geração notas fiscais.

# Documentação Bling

Para acessar, basca clicar [aqui](https://manuais.bling.com.br/api/?item=notas-fiscais)

# Exemplo

```php
require __DIR__ . '/vendor/autload.php';

$bling = new \Bling\NotaFiscal\Bling('sua-api-key');
$nota = $bling->buscaNotaFiscal('numero-nota', 'serie'); // Retorna NotaFiscal()

echo $nota->getChaveAcesso();
```
