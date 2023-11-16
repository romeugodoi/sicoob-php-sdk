<?php

namespace Logics\SicoobSdk;

use Exception;
use InvalidArgumentException;
use Logics\SicoobSdk\DTO\Boleto;
use Logics\SicoobSdk\DTO\ResultRequest;
use Logics\SicoobSdk\Enum\CodigoSituacaoParam;
use Logics\SicoobSdk\Enum\Modalidade;
use Logics\SicoobSdk\Enum\TipoMovimentacao;
use Logics\SicoobSdk\Model\CobrancaBancariaModel;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarEspecieDocumento;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarInformacoesDesconto;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarInformacoesPagador;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarParaUtilizarPIX;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarSeuNumeroIdBoletoEmpresa;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarValorAbatimento;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarValorJurosMora;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarValorMulta;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarValorNominalBoletoCartaoCredito;
use Logics\SicoobSdk\Payload\CobrancaBancaria\BaixarNegativacao;
use Logics\SicoobSdk\Payload\CobrancaBancaria\CancelarApontamentoNegativacao;
use Logics\SicoobSdk\Payload\CobrancaBancaria\CancelarApontamentoProtesto;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ComandarBaixa;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ComandarRateioCredito;
use Logics\SicoobSdk\Payload\CobrancaBancaria\DesistirProtesto;
use Logics\SicoobSdk\Payload\CobrancaBancaria\NegativarPagadores;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ProrrogarDataLimitePagamento;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ProrrogarDataVencimento;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ProtestarBoleto;
use Psr\Http\Message\ResponseInterface;

class CobrancaBancaria
{
    public function __construct(
        private readonly Authenticator $authenticator,
        private readonly int $numeroContrato,
    ) {}

    /**
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#1bcf3134-afbd-4cf3-ba49-9cdf5ea2c224
     */
    public function incluirBoleto(Boleto $boleto): Boleto
    {
        try {
            $boleto->setNumeroContrato($this->numeroContrato);

            $clientRequest = new ClientRequest($this->authenticator);


            $response = $clientRequest->request('POST', '/boletos', [$boleto->toArray()]);

            $response = json_decode($response->getBody()->getContents());

            return Boleto::createFromJsonArray($response->resultado[0]->boleto);
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao gerar o boleto: ' . $e->getMessage());
        }

    }

    /**
     * @param string|null $linhaDigital Número da linha digitável do boleto com 47 posições. Caso seja informado, não é necessário informar o nosso número ou código de barras.
     * @param string|null $codigoBarras Número de código de barras do boleto com 44 posições.Caso seja informado, não é necessário informar o nosso número ou linha digitável.
     * @param string|null $nossoNumero Número identificador do boleto no Sisbr. Caso seja infomado, não é necessário infomar a linha digitável ou código de barras.
     * @return Boleto
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#cb15c3cb-dc4a-475e-8a60-cceb2bc3285d
     */
    public function consultarBoleto(?string $linhaDigital = null, ?string $codigoBarras = null, ?string $nossoNumero = null): Boleto
    {
        try {
            CobrancaBancariaModel::validateSearchParamFindBoleto($linhaDigital, $codigoBarras, $nossoNumero);

            $params = CobrancaBancariaModel::getSearchParamsBoleto($this->numeroContrato, $linhaDigital, $codigoBarras, $nossoNumero);
            $clientRequest = new ClientRequest($this->authenticator);

            $uri = "/boletos{$params}";

            $response = $clientRequest->request('GET', $uri);

            $response = json_decode($response->getBody()->getContents());

            return Boleto::createFromJsonArray($response->resultado);
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao consultar o boleto: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#f969814d-6332-4a7c-979d-316f50f36360
     * @param $dataInicio string Data de Vencimento Inicial. yyyy-MM-dd
     * @param $dataFim string Data de Vencimento Final. yyyy-MM-dd
     */
    public function listarBoletosPorPagador(CodigoSituacaoParam $codigoSituacao, string $dataInicio, string $dataFim, string $numeroCpfCnpj): array
    {
        try {
            $requiredProps = [
                $codigoSituacao,
                $dataInicio,
                $dataFim,
                $numeroCpfCnpj
            ];

            if (in_array(null, $requiredProps)) {
                throw new InvalidArgumentException("Todos os parâmetros são obrigatórios. (codigoSituacao, dataInicio, dataFim, numeroCpfCnpj)");
            }

            $params = "?numeroContrato={$this->numeroContrato}&codigoSituacao={$codigoSituacao->value}&dataInicio={$dataInicio}&dataFim={$dataFim}";

            $clientRequest = new ClientRequest($this->authenticator);

            $uri = "/boletos/pagadores/{$numeroCpfCnpj}{$params}";

            $response = $clientRequest->request('GET', $uri);

            $response = json_decode($response->getBody()->getContents());

            if(is_array($response->resultado)) {
                $boletos = [];

                foreach ($response->resultado as $boleto) {
                    $boletos[] = Boleto::createFromJsonArray($boleto);
                }

                return $boletos;
            } else {
                return [
                    'boletos' => [Boleto::createFromJsonArray($response->resultado)]
                ];
            }
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao consultar o boleto: ' . $e->getMessage());
        }
    }

    /**
     * @param bool $gerarPdf
     * @param string|null $linhaDigital Número da linha digitável do boleto com 47 posições. Caso seja informado, não é necessário informar o nosso número ou código de barras.
     * @param string|null $codigoBarras Número de código de barras do boleto com 44 posições.Caso seja informado, não é necessário informar o nosso número ou linha digitável.
     * @param string|null $nossoNumero Número identificador do boleto no Sisbr. Caso seja infomado, não é necessário infomar a linha digitável ou código de barras.
     * @return Boleto
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#f1bed281-b919-4535-99ed-9d3e08283b70
     */
    public function emitirSegundaViaBoleto(bool $gerarPdf, ?string $linhaDigital = null, ?string $codigoBarras = null, ?string $nossoNumero = null): Boleto
    {
        try {
            CobrancaBancariaModel::validateSearchParamFindBoleto($linhaDigital, $codigoBarras, $nossoNumero);

            $params = CobrancaBancariaModel::getSearchParamsBoleto($this->numeroContrato, $linhaDigital, $codigoBarras, $nossoNumero);
            $params .= "&gerarPdf={$gerarPdf}";
            $uri = "/boletos/segunda-via{$params}";

            $clientRequest = new ClientRequest($this->authenticator);

            $response = $clientRequest->request('GET', $uri);

            $response = json_decode($response->getBody()->getContents());

            return Boleto::createFromJsonArray($response->resultado);
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao gerar a segunda via do boleto: ' . $e->getMessage());
        }

    }

    /**
     * @param ProrrogarDataVencimento[] $payloadBoletosProrrogarVencimento - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#3a37e9b9-ae04-4309-a135-542671cd506d
     */
    public function prorrogarDataVencimentoBoletos(array $payloadBoletosProrrogarVencimento): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($payloadBoletosProrrogarVencimento, ProrrogarDataVencimento::class);

            $body = [];

            foreach ($payloadBoletosProrrogarVencimento as $dataBoletoProrrogarVencimento) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletoProrrogarVencimento->getNossoNumero(),
                    'dataVencimento' => $dataBoletoProrrogarVencimento->getDataVencimento(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/prorrogacoes/data-vencimento', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'prorrogacao' => ProrrogarDataVencimento::createFromJsonArray($item->prorrogacao)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao prorrogar o vencimento dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param ProrrogarDataLimitePagamento[] $dataBoletosChangeDate - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#81c9fe1b-8c44-4a17-a228-53d91b5064c2
     */
    public function prorrogarDataLimitePagamentoBoletos(array $dataBoletosChangeDate): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($dataBoletosChangeDate, ProrrogarDataLimitePagamento::class);

            $body = [];

            foreach ($dataBoletosChangeDate as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'dataLimitePagamento' => $dataBoletos->getDataLimitePagamento(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/prorrogacoes/data-limite-pagamento', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'prorrogacao' => ProrrogarDataLimitePagamento::createFromJsonArray($item->prorrogacao)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao prorrogar a data limite de pagemento dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param AlterarInformacoesDesconto[] $dataBoletosChangeDesconto - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#e1a591a9-8935-4105-bad6-931bcc14a583
     */
    public function alterarInformacoesDescontoBoletos(array $dataBoletosChangeDesconto): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($dataBoletosChangeDesconto, AlterarInformacoesDesconto::class);

            $body = [];

            foreach ($dataBoletosChangeDesconto as $dataBoletos) {
                $itemArray = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'tipoDesconto' => $dataBoletos->getTipoDesconto(),
                    'valorPrimeiroDesconto' => $dataBoletos->getValorPrimeiroDesconto() ?? 0,
                    'valorSegundoDesconto' => $dataBoletos->getValorSegundoDesconto() ?? 0,
                    'valorTerceiroDesconto' => $dataBoletos->getDataTerceiroDesconto() ?? 0,
                ];

                if($dataBoletos->getDataPrimeiroDesconto()) {
                    $itemArray['dataPrimeiroDesconto'] = $dataBoletos->getDataPrimeiroDesconto();
                }

                if($dataBoletos->getDataSegundoDesconto()) {
                    $itemArray['dataSegundoDesconto'] = $dataBoletos->getDataSegundoDesconto();
                }

                if($dataBoletos->getDataTerceiroDesconto()) {
                    $itemArray['dataTerceiroDesconto'] = $dataBoletos->getDataTerceiroDesconto();
                }

                $body[] = $itemArray;
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/descontos', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'desconto' => AlterarInformacoesDesconto::createFromJsonArray($item->desconto)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao alterar informações de desconto dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param AlterarValorAbatimento[] $boletosToChangeValorAbatimento - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#2aeb68fb-11f0-4ee9-941f-91ae00fb7743
     */
    public function alterarValorAbatimentoBoletos(array $boletosToChangeValorAbatimento): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToChangeValorAbatimento, AlterarValorAbatimento::class);

            $body = [];

            foreach ($boletosToChangeValorAbatimento as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'valorAbatimento' => $dataBoletos->getValorAbatimento(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/abatimentos', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'abatimento' => AlterarValorAbatimento::createFromJsonArray($item->abatimento)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao alterar o valor de abatimento dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param AlterarValorMulta[] $boletosToChangeValorMulta - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#ca8c2a45-6c68-474d-b3ad-3e2b46b38657
     */
    public function alterarValorMultaBoletos(array $boletosToChangeValorMulta): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToChangeValorMulta, AlterarValorMulta::class);

            $body = [];

            foreach ($boletosToChangeValorMulta as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'tipoMulta' => $dataBoletos->getTipoMulta(),
                    'dataMulta' => $dataBoletos->getDataMulta(),
                    'valorMulta' => $dataBoletos->getValorMulta(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/encargos/multas', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'encargo' => AlterarValorMulta::createFromJsonArray($item->encargo)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao alterar o valor da multa dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param AlterarValorJurosMora[] $boletosToChangeValorJurosMora - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#41096d19-d601-4df9-8ec2-8a4c72138b76
     */
    public function alterarValorJurosMoraBoletos(array $boletosToChangeValorJurosMora): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToChangeValorJurosMora, AlterarValorJurosMora::class);

            $body = [];

            foreach ($boletosToChangeValorJurosMora as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'tipoJurosMora' => $dataBoletos->getTipoJurosMora(),
                    'dataJurosMora' => $dataBoletos->getDataJurosMora(),
                    'valorJurosMora' => $dataBoletos->getValorJurosMora(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/encargos/juros-mora', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'encargo' => AlterarValorJurosMora::createFromJsonArray($item->encargo)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao alterar o valor do juros mora dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param AlterarValorNominalBoletoCartaoCredito[] $boletosToChangeValorNominal - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#97aa592b-09a2-49cc-8641-c2dfe343c50c
     */
    public function alterarValorNominalBoletosCartaoCredito(array $boletosToChangeValorNominal): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToChangeValorNominal, AlterarValorNominalBoletoCartaoCredito::class);

            $body = [];

            foreach ($boletosToChangeValorNominal as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'valor' => $dataBoletos->getValor(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/valor-nominal', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'valorNominal' => AlterarValorNominalBoletoCartaoCredito::createFromJsonArray($item->valorNominal)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao alterar o valor nominal dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param AlterarSeuNumeroIdBoletoEmpresa[] $boletosToChangeSeuNumeroOuIdBoletoEmpresa - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#8191a547-8fc8-4fb3-8008-daa374fcd4e7
     */
    public function alterarSeuNumeroOuIdBoletoEmpresaBoletos(array $boletosToChangeSeuNumeroOuIdBoletoEmpresa): array
    {
        try {
            CobrancaBancariaModel::validateBoletosToChangeSeuNumeroOuIdBoletoEmpresa($boletosToChangeSeuNumeroOuIdBoletoEmpresa);

            $body = [];

            foreach ($boletosToChangeSeuNumeroOuIdBoletoEmpresa as $dataBoletos) {
                $itemArray = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                ];

                if($dataBoletos->getSeuNumero()) {
                    $itemArray['seuNumero'] = $dataBoletos->getSeuNumero();
                }

                if($dataBoletos->getIdentificacaoBoletoEmpresa()) {
                    $itemArray['identificacaoBoletoEmpresa'] = $dataBoletos->getIdentificacaoBoletoEmpresa();
                }

                $body[] = $itemArray;
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/seu-numero', $body);

            $resultArray = json_decode($result->getBody()->getContents(), true);

            $response = [];

            foreach ($resultArray['resultado'] as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item['status']),
                    'seu-numero' => AlterarSeuNumeroIdBoletoEmpresa::createFromJsonArray($item['seu-numero'])
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao alterar as identificações dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param AlterarEspecieDocumento[] $boletosToChangeEspecieDocumento - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#f7a6b3e0-bd2a-40ef-9170-3547d8bad5da
     */
    public function alterarEspecieDocumentoBoletos(array $boletosToChangeEspecieDocumento): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToChangeEspecieDocumento, AlterarEspecieDocumento::class);

            $body = [];

            foreach ($boletosToChangeEspecieDocumento as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'especieDocumento' => $dataBoletos->getEspecieDocumento(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/especie-documento', $body);

            $resultArray = json_decode($result->getBody()->getContents(), true);

            $response = [];

            foreach ($resultArray['resultado'] as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item['status']),
                    'especie-documento' => AlterarEspecieDocumento::createFromJsonArray($item['especie-documento'])
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao alterar a espécie de documento dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param ComandarBaixa[] $boletosToComandarBaixa - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#f9d41dd1-178f-47b2-ada8-453620377bca
     */
    public function comandarBaixaBoletos(array $boletosToComandarBaixa): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToComandarBaixa, ComandarBaixa::class);

            $body = [];

            foreach ($boletosToComandarBaixa as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'seuNumero' => $dataBoletos->getSeuNumero(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/baixa', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'baixa' => ComandarBaixa::createFromJsonArray($item->baixa)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao comandar a baixa dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param ComandarRateioCredito[] $boletosToComandarRateioCredito - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#de10cd80-76bc-4ccf-8d0a-d1f50a3351f1
     */
    public function comandarRateioCreditoBoletos(array $boletosToComandarRateioCredito): array
    {
        try {
            CobrancaBancariaModel::validateBoletosToComandarRateioDeCredito($boletosToComandarRateioCredito);

            $body = [];

            foreach ($boletosToComandarRateioCredito as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'tipoOperacao' => 3,
                    'rateioCreditos' => CobrancaBancariaModel::prepareArrayRateioCredito($dataBoletos->getRateiosCredito()),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/rateio-creditos', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'boletos' => ComandarRateioCredito::createFromJsonArray($item->boletos)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao comandar o rateio de credito nos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param AlterarParaUtilizarPIX[] $boletosToChangeUtilizarPix - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#7c234842-1c26-4351-b7b1-a27e0d96c279
     */
    public function alterarBoletoParaUtilizarPix(array $boletosToChangeUtilizarPix): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToChangeUtilizarPix, AlterarParaUtilizarPIX::class);

            $body = [];

            foreach ($boletosToChangeUtilizarPix as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'utilizarPix' => true,
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/pix', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'pix' => AlterarParaUtilizarPIX::createFromJsonArray($item->pix)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao alterar a utilização de PIX dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param AlterarInformacoesPagador[] $boletosToChangePagador - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#304f14b0-83be-4a4c-b30e-9bfbb3d5ac6c
     */
    public function alterarInformacoesPagadorBoletos(array $boletosToChangePagador): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToChangePagador, AlterarInformacoesPagador::class);

            $body = [];

            foreach ($boletosToChangePagador as $dataBoletos) {
                $pagador = $dataBoletos->getPagador();

                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                    'numeroCpfCnpj' => $pagador->getNumeroCpfCnpj(),
                    'nome' => $pagador->getNome(),
                    'endereco' => $pagador->getEndereco(),
                    'bairro' => $pagador->getBairro(),
                    'cidade' => $pagador->getCidade(),
                    'cep' => strval($pagador->getCep()),
                    'uf' => $pagador->getUf(),
                    'email' => $pagador->getEmail(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PUT', '/pagadores', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'pagador' => AlterarInformacoesPagador::createFromJsonArray($item->pagador)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao alterar o pagador dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param BaixarNegativacao[] $boletosToBaixarNegativacaoPagadores - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#df838452-535f-4dda-8d4c-254c12ee31fb
     */
    public function baixarNegativacaoPagadores(array $boletosToBaixarNegativacaoPagadores): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToBaixarNegativacaoPagadores, BaixarNegativacao::class);

            $body = [];

            foreach ($boletosToBaixarNegativacaoPagadores as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('DELETE', '/boletos/negativacoes', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'negativacao' => BaixarNegativacao::createFromJsonArray($item->negativacao)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao baixar a negativação dos pagadores: ' . $e->getMessage());
        }
    }

    /**
     * @param NegativarPagadores[] $boletosToNegativarPagadores - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#175f0332-4aab-4063-9ab9-2abd2ce0fe43
     */
    public function negativarPagadores(array $boletosToNegativarPagadores): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToNegativarPagadores, NegativarPagadores::class);

            $body = [];

            foreach ($boletosToNegativarPagadores as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('POST', '/boletos/negativacoes', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'negativacao' => NegativarPagadores::createFromJsonArray($item->negativacao)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao negativar os pagadores: ' . $e->getMessage());
        }
    }

    /**
     * @param CancelarApontamentoNegativacao[] $boletosToCancelApontamentoNegativacaoPagadores - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#16305b4e-4490-49de-b47b-da40ba266e9a
     */
    public function cancelarApontamentoNegativacaoPagadores(array $boletosToCancelApontamentoNegativacaoPagadores): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToCancelApontamentoNegativacaoPagadores, CancelarApontamentoNegativacao::class);

            $body = [];

            foreach ($boletosToCancelApontamentoNegativacaoPagadores as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/negativacoes', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'negativacao' => CancelarApontamentoNegativacao::createFromJsonArray($item->negativacao)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao cancelar o apontamento da negativação de pagadores: ' . $e->getMessage());
        }
    }

    /**
     * @param DesistirProtesto[] $boletosToDesistirProtesto - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#b27936c3-b7e0-446a-b5f7-d167ba240eca
     */
    public function desistitProtestoBoletos(array $boletosToDesistirProtesto): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToDesistirProtesto, DesistirProtesto::class);

            $body = [];

            foreach ($boletosToDesistirProtesto as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('DELETE', '/boletos/protestos', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'protesto' => DesistirProtesto::createFromJsonArray($item->protesto)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao desistir do protesto dos boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param CancelarApontamentoProtesto[] $boletosToCancelarApontamentoProtesto - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#cd36bd47-152d-47a6-b8a2-3f8fc6ea68a3
     */
    public function cancelarApontamentoProtestoBoletos(array $boletosToCancelarApontamentoProtesto): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToCancelarApontamentoProtesto, CancelarApontamentoProtesto::class);

            $body = [];

            foreach ($boletosToCancelarApontamentoProtesto as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('PATCH', '/boletos/protestos', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'protesto' => CancelarApontamentoProtesto::createFromJsonArray($item->protesto)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao cancelar o apontamento de prostesto de boletos: ' . $e->getMessage());
        }
    }

    /**
     * @param ProtestarBoleto[] $boletosToProtestar - Máximo de 10 itens
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#bd4bef2d-ab63-41ed-acaf-7d5d0400b4af
     */
    public function protestarBoletos(array $boletosToProtestar): array
    {
        try {
            CobrancaBancariaModel::validatePayloadCobrancaBancaria($boletosToProtestar, ProtestarBoleto::class);

            $body = [];

            foreach ($boletosToProtestar as $dataBoletos) {
                $body[] = [
                    'numeroContrato' => $this->numeroContrato,
                    'modalidade' => Modalidade::SIMPLES_COM_REGISTRO,
                    'nossoNumero' => $dataBoletos->getNossoNumero(),
                ];
            }

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('POST', '/boletos/protestos', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            $response = [];

            foreach ($resultArray->resultado as $item) {
                $response[] = [
                    'result' => ResultRequest::createFromJsonArray($item->status),
                    'protesto' => ProtestarBoleto::createFromJsonArray($item->protesto)
                ];
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao protestar os boletos: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#1b0da494-04c4-4053-9d87-0b4f4586287d
     */
    public function solicitarMovimentacaoCarteiraBeneficiario(TipoMovimentacao $tipoMovimentacao, string $dataInicial, string $dataFinal): array
    {
        try {
            $body = [
                'numeroContrato' => $this->numeroContrato,
                'tipoMovimento' => $tipoMovimentacao->value,
                'dataInicial' => $dataInicial,
                'dataFinal' => $dataFinal,
            ];

            $clientRequest = new ClientRequest($this->authenticator);

            $result = $clientRequest->request('POST', '/boletos/solicitacoes/movimentacao', $body);

            $resultArray = json_decode($result->getBody()->getContents());

            return [
                'statusCode' => $result->getStatusCode(),
                'resultado' => $resultArray->resultado
            ];
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao solicitar a movimentação da carteira do beneficiário: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#85985f79-8ee7-4ef8-9303-cda9dd0afffc
     */
    public function consultarSituacaoSolicitacaoMovimentacao(int $codigoSolicitacao): array
    {
        try {
            $clientRequest = new ClientRequest($this->authenticator);

            $params = "?numeroContrato={$this->numeroContrato}&codigoSolicitacao={$codigoSolicitacao}";

            $result = $clientRequest->request('GET', "/boletos/solicitacoes/movimentacao{$params}");

            $resultArray = json_decode($result->getBody()->getContents());

            return [
                'statusCode' => $result->getStatusCode(),
                'resultado' => $resultArray->resultado
            ];
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao protestar os boletos: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     * @link https://documenter.getpostman.com/view/20565799/Uzs6yNhe#5dc892be-9a11-4673-8ba1-4eb5cee2cea0
     */
    public function downloadArquivoMovimentacao(int $codigoSolicitacao, int $idArquivo): array
    {
        try {
            $clientRequest = new ClientRequest($this->authenticator);

            $params = "?numeroContrato={$this->numeroContrato}&codigoSolicitacao={$codigoSolicitacao}&idArquivo={$idArquivo}";

            $result = $clientRequest->request('GET', "/boletos/movimentacao-download{$params}");

            $resultArray = json_decode($result->getBody()->getContents());

            return [
                'statusCode' => $result->getStatusCode(),
                'resultado' => $resultArray->resultado
            ];
        } catch (Exception $e) {
            throw new Exception('Ocorreu um erro ao protestar os boletos: ' . $e->getMessage());
        }
    }
}
