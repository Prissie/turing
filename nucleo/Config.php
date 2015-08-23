<?php

/*
* Classe Config.
* Serve para pegar as configurações nos arquivo config do sistema.
*/
class Config
{

    public static $configuracao;

    /*
    *  Verifica se o arquivo de configuração existe.
    *  @return a configuração
    */
    public static function pegar($valor)
    {
        if (!self::$configuracao) {

	        $arquivo_config = '../config/config.' . Desenvolvimento::pegar() . '.php';

			if (!file_exists($arquivo_config)) {
				return false;
			}

	        self::$configuracao = require $arquivo_config;
        }

        return self::$configuracao[$valor];
    }
}
