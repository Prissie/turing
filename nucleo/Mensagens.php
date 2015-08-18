<?php

/*
* Classe Mensagens
* Serve para pegar as mensagens de erro do app.
* Utilize Mensagens::pegar();
*/

class Mensagens
{
    private static $textos;

    public static function pegar($valor)
    {
	    
	    if (!$valor) {
		    return null;
	    }

	    
        if (!self::$textos) {
            self::$textos = require('../config/mensagens.php');
        }

	   
	    if (!array_key_exists($valor, self::$textos)) {
		    return null;
	    }

        return self::$textos[$valor];
    }

}
