<?php

namespace Logics\SicoobSdk\Model;

use InvalidArgumentException;
use Logics\SicoobSdk\DTO\Boleto;
use Logics\SicoobSdk\DTO\Pagador;
use Logics\SicoobSdk\DTO\RateioCredito;
use Logics\SicoobSdk\Enum\EspecieDocumento;
use Logics\SicoobSdk\Enum\Modalidade;
use Logics\SicoobSdk\Enum\TipoDesconto;
use Logics\SicoobSdk\Enum\TipoJurosMora;
use Logics\SicoobSdk\Enum\TipoMulta;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarInformacoesDesconto;
use Logics\SicoobSdk\Payload\CobrancaBancaria\AlterarSeuNumeroIdBoletoEmpresa;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ComandarRateioCredito;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ProrrogarDataLimitePagamento;
use Logics\SicoobSdk\Payload\CobrancaBancaria\ProrrogarDataVencimento;


class CobrancaBancariaModel
{
    const defaultMessageErrorNotProvidedSearchParam = "Pelo menos uma das propriedades deve ser fornecida. (linhaDigital, codigoBarras, nossoNumero)";
    const defaultMessageErrorInvalidNumberOfBoletosToChange = "A quantidade de boletos para alteração deve ser entre 1 e 10.";

    const MAX_BOLETOS_TO_CHANGE = 10;

    public static function getSearchParamsBoleto(int $numeroContrato, ?string $linhaDigital, ?string $codigoBarras, ?string $nossoNumero): string
    {
        $modalidade = Modalidade::SIMPLES_COM_REGISTRO->value;
        $params = "?numeroContrato={$numeroContrato}&modalidade={$modalidade}";

        if ($linhaDigital) {
            $params .= "&linhaDigitavel={$linhaDigital}";
            return $params;
        }

        if ($codigoBarras) {
            $params .= "&codigoBarras={$codigoBarras}";
            return $params;
        }

        if ($nossoNumero) {
            $params .= "&nossoNumero={$nossoNumero}";
            return $params;
        }

        return $params;
    }

    public static function validateSearchParamFindBoleto(?string $linhaDigital, ?string $codigoBarras, ?string $nossoNumero): void
    {
        if ($linhaDigital === null && $codigoBarras === null && $nossoNumero === null) {
            throw new InvalidArgumentException(self::defaultMessageErrorNotProvidedSearchParam);
        }
    }

    private static function validateInstance(array $payload, string $expectedInstance): void
    {
        foreach ($payload as $itemPayload) {
            if (!($itemPayload instanceof $expectedInstance)) {
                throw new InvalidArgumentException("O payload deve ser um array de instâncias de '$expectedInstance'.");
            }
        }
    }

    public static function prepareArrayRateioCredito(array $rateios): array
    {
        return array_map(function (RateioCredito $rateio) {
            return $rateio->toArray();
        }, $rateios);
    }

    public static function validateQtyBoletosToChangeIsValid(array $boletos): void
    {
        $isValid = count($boletos) <= self::MAX_BOLETOS_TO_CHANGE && count($boletos) > 0;

        if (!$isValid) {
            throw new InvalidArgumentException(self::defaultMessageErrorInvalidNumberOfBoletosToChange);
        }
    }

    public static function validatePayloadCobrancaBancaria(array $boletos, string $expectedInstace): void
    {
        self::validateQtyBoletosToChangeIsValid($boletos);
        self::validateInstance($boletos, $expectedInstace);
    }

    public static function validateBoletosToChangeSeuNumeroOuIdBoletoEmpresa(array $boletos): void
    {
        self::validateQtyBoletosToChangeIsValid($boletos);
        self::validateInstance($boletos, AlterarSeuNumeroIdBoletoEmpresa::class);

        /** @var AlterarSeuNumeroIdBoletoEmpresa $boleto */
        foreach ($boletos as $boleto) {
            if(!$boleto->getSeuNumero() && !$boleto->getIdentificacaoBoletoEmpresa()) {
                throw new InvalidArgumentException("Pelo menos uma das chaves deve ser fornecida. (seuNumero, identificacaoBoletoEmpresa)");
            }
        }
    }

    public static function validateBoletosToComandarRateioDeCredito(array $boletos): void
    {
        self::validateQtyBoletosToChangeIsValid($boletos);
        self::validateInstance($boletos, ComandarRateioCredito::class);

        /** @var ComandarRateioCredito $boleto */
        foreach ($boletos as $boleto) {
            foreach ($boleto->getRateiosCredito() as $rateio) {
                if(!($rateio instanceof RateioCredito)) {
                    throw new InvalidArgumentException("A valor de 'rateioCreditos' deve ser um array de instâncias de objeto da classe RateioCredito.");
                }
            }
        }
    }
}