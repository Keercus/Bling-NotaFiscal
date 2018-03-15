<?php declare(strict_types=1);

namespace Bling\NotaFiscal\Entity;

class NotaFiscal
{
    const AUTORIZADA = 'Autorizada';

    const PENDENTE = 'Pendente';

    const EMITIDA = 'Emitida';

    const CANCELADA = 'Cancelada';

    const ENVIADA_RECIBO = 'Enviada - Aguardando recibo';

    const REJEITADA = 'Rejeitada';

    const EMITIDA_DANFE = 'Emitida DANFE';

    const REGISTRADA = 'Registrada';

    const ENVIADA_PROTOCOLO = 'Enviada - Aguardando protocolo';

    const DENEGADA = 'Denegada';

    private $chaveAcesso;

    private $xmlLink;

    private $danfeLink;

    private $numero;

    private $serie;

    private $situacao;

    public function __construct(
        string $chaveAcesso,
        string $numero,
        string $serie,
        string $situacao = self::PENDENTE,
        ?string $xmlLink = '',
        ?string $danfeLink = ''
    ) {
        $this->chaveAcesso = $chaveAcesso;
        $this->numero = $numero;
        $this->serie = $serie;
        $this->xmlLink = $xmlLink;
        $this->danfeLink = $danfeLink;
        $this->situacao = $situacao;
    }

    public function getChaveAcesso(): string
    {
        return $this->chaveAcesso;
    }

    public function getXmlLink(): ?string
    {
        return $this->xmlLink;
    }

    public function getDanfeLink(): ?string
    {
        return $this->danfeLink;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getSerie(): string
    {
        return $this->serie;
    }

    public function getSituacao(): string
    {
        return $this->situacao;
    }

    public function isSituacao(string $situacao): bool
    {
        return $this->situacao == $situacao;
    }
}
