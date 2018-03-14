<?php declare(strict_types=1);

namespace Tests\Entity;

use PHPUnit\Framework\TestCase;
use Bling\NotaFiscal\Entity\Cliente;
use Bling\NotaFiscal\Entity\Endereco;

class ClienteTest extends TestCase
{
    public function testInitialization(): void
    {
        $endereco = new Endereco(
            'Teste',
            '123',
            'Teste',
            'Teste',
            '12345789',
            'Teste',
            'Ts'
        );

        $nome = 'Teste';
        $tipoPessoa = Cliente::TIPO_FISICA;
        $cpfCnpj = '12345678911';
        $fone = '12345678';
        $email = 'teste@teste.com';
        $cliente = new Cliente(
            $nome,
            $tipoPessoa,
            $cpfCnpj,
            $fone,
            $email,
            $endereco
        );

        $this->assertInstanceOf(Cliente::class, $cliente);
        $this->assertEquals($nome, $cliente->getNome());
        $this->assertEquals($tipoPessoa, $cliente->getTipoPessoa());
        $this->assertEquals($cpfCnpj, $cliente->getCpfCnpj());
        $this->assertEquals($fone, $cliente->getFone());
        $this->assertEquals($email, $cliente->getEmail());
        $this->assertInstanceOf(Endereco::class, $cliente->getEndereco());
    }
}
