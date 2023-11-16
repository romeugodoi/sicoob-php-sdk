<?php

namespace Logics\SicoobSdk\Config;

abstract class ProductionData
{
    const BASE_URI = "https://api.sicoob.com.br";
    const SUFIX_API_COBRANCA_BANCARIA = "/cobranca-bancaria";
    const API_VERSION = 'v2';
    const API_URI = self::SUFIX_API_COBRANCA_BANCARIA . '/' . self::API_VERSION;
}