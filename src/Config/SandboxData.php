<?php

namespace Logics\SicoobSdk\Config;

abstract class SandboxData
{
    const TOKEN = "1301865f-c6bc-38f3-9f49-666dbcfc59c3";
    const BASE_URI = "https://sandbox.sicoob.com.br";
    const SUFIX_API_COBRANCA_BANCARIA = "/sicoob/sandbox/cobranca-bancaria";
    const API_VERSION = 'v2';
    const API_URI = self::SUFIX_API_COBRANCA_BANCARIA . '/' . self::API_VERSION;
}