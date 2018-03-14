<?php declare(strict_types=1);

namespace Bling\NotaFiscal\Entity;

class Item
{
    const UNIDADE_CX = 'cx';

    const UNIDADE_PC = 'pc';

    const UNIDADE_UN = 'un';

    const TIPO_PRODUTO = 'P';

    const TIPO_SERVICO = 'S';

    private $codigo;

    private $descricao;

    private $un;

    private $quantidade = 1;

    private $valorUnitario;

    private $tipo;

    private $pesoBruto;

    private $pesoLiquido;

    // NCM
    private $classFiscal;

    private $origem = 0;

    public function __construct(
        string $codigo,
        string $descricao,
        float $valorUnitario,
        float $pesoBruto,
        float $pesoLiquido,
        string $classFiscal,
        int $quantidade = 1,
        string $origem = '0',
        string $un = self::UNIDADE_UN,
        string $tipo = self::TIPO_PRODUTO
    ) {
        $this->codigo = $codigo;
        $this->descricao = $descricao;
        $this->valorUnitario = $valorUnitario;
        $this->pesoBruto = $pesoBruto;
        $this->pesoLiquido = $pesoLiquido;
        $this->classFiscal = $classFiscal;
        $this->quantidade = $quantidade;
        $this->origem = $origem;
        $this->un = $un;
        $this->tipo = $tipo;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getUn(): string
    {
        return $this->un;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function getValorUnitario(): float
    {
        return $this->valorUnitario;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getPesoBruto(): float
    {
        return $this->pesoBruto;
    }

    public function getPesoLiquido(): float
    {
        return $this->pesoLiquido;
    }

    public function getClassFiscal(): string
    {
        return $this->classFiscal;
    }

    public function getOrigem(): string
    {
        return $this->origem;
    }
}
