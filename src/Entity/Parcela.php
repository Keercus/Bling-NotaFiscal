<?php declare(strict_types=1);

namespace Bling\Entity;

class Parcela
{
    private $dias = 1;

    private $data;

    private $valor;

    private $observacao;

    private $formaPagamento;

    public function __construct(
        string $data,
        float $valor,
        int $dias = 1,
        string $observacao = '-',
        string $formaPagamento = ''
    ) {
        $this->data = $data;
        $this->valor = $valor;
        $this->dias = $dias;
        $this->observacao = $observacao;
        $this->formaPagamento = $formaPagamento;
    }

    public function getDias(): int
    {
        return $this->dias;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getObservacao(): string
    {
        return $this->observacao;
    }

    public function getFormaPagamento(): string
    {
        return $this->formaPagamento;
    }
}
