<?php declare(strict_types=1);

namespace Bling\NotaFiscal\Entity;

use Bling\NotaFiscal\Entity\Cliente;

class Pedido
{
    private $numeroNotaFiscal;

    private $cliente;

    private $itens = [];

    private $parcelas = [];

    private $valorFrete;

    private $valorSeguro;

    private $valorDespesas;

    private $valorDesconto;

    private $observacao;

    public function __construct(
        string $numeroNotaFiscal,
        Cliente $cliente,
        array $itens = [],
        float $valorDesconto = 0,
        array $parcelas = [],
        float $valorFrete = 0,
        float $valorSeguro = 0,
        float $valorDespesas = 0,
        string $observacao = ''
    ) {
        $this->numeroNotaFiscal = $numeroNotaFiscal;
        $this->cliente = $cliente;
        $this->itens = $itens;
        $this->valorDesconto = $valorDesconto;
        $this->parcelas = $parcelas;
        $this->valorFrete = $valorFrete;
        $this->valorSeguro = $valorSeguro;
        $this->valorDespesas = $valorDespesas;
        $this->observacao = $observacao;
    }

    public function getNumeroNotaFiscal(): string
    {
        return $this->numeroNotaFiscal;
    }

    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    public function getItens(): array
    {
        return $this->itens;
    }

    public function getParcelas(): array
    {
        return $this->parcelas;
    }

    public function getValorFrete(): float
    {
        return $this->valorFrete;
    }

    public function getValorSeguro(): float
    {
        return $this->valorSeguro;
    }

    public function getValorDespesas(): float
    {
        return $this->valorDespesas;
    }

    public function getValorDesconto(): float
    {
        return $this->valorDesconto;
    }

    public function getObservacao(): string
    {
        return $this->observacao;
    }
}
