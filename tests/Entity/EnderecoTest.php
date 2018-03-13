<?php declare(strict_types=1);

namespace Tests\Entity;

use PHPUnit\Framework\TestCase;
use Bling\Entity\Cliente;
use Bling\Entity\Endereco;

class EnderecoTest extends TestCase
{
    public function testInitialization(): void
    {
        $endereco = 'Teste';
        $numero = '123';
        $complemento = 'Teste Complemento';
        $bairro = 'Teste Bairro';
        $cep = '12345789';
        $cidade = 'Teste Cidade';
        $uf = 'Ts';
        $enderecoObj = new Endereco(
            $endereco,
            $numero,
            $complemento,
            $bairro,
            $cep,
            $cidade,
            $uf
        );

        $this->assertInstanceOf(Endereco::class, $enderecoObj);
        $this->assertEquals($endereco, $enderecoObj->getEndereco());
        $this->assertEquals($numero, $enderecoObj->getNumero());
        $this->assertEquals($complemento, $enderecoObj->getComplemento());
        $this->assertEquals($bairro, $enderecoObj->getBairro());
        $this->assertEquals($cep, $enderecoObj->getCep());
        $this->assertEquals($cidade, $enderecoObj->getCidade());
        $this->assertEquals($uf, $enderecoObj->getUf());
    }
}
