<?php

/*
*   Classe de Requisições
*   São feitas todas as requisições de post e get através dessa classe.
*/

class Requisitar
{

    /*
    *   Requisições de post são feitas nesse método.
    *   Utilize : Requisitar::post('x') para normal e Requisitar::post('x', true) para limpar
    */
    public static function post($valor, $limpar = false)
    {
        if (isset($_POST[$valor])) {
            return ($limpar) ? trim(strip_tags($_POST[$valor])) : $_POST[$valor];
        }
    }

    /*
    *   Requisições de post da checkbox são feitas nesse método.
    */
 
    public static function postCheckbox($valor)
    {
        return isset($_POST[$valor]) ? 1 : NULL;
    }

    /*
    *   Requisições de post da get são feitas nesse método.
    */
    public static function pegar($valor)
    {
        if (isset($_GET[$valor])) {
            return $_GET[$valor];
        }
    }

    /*
    *   Requisições de post da cookie são feitas nesse método.
    */ 
    public static function cookie($valor)
    {
        if (isset($_COOKIE[$valor])) {
            return $_COOKIE[$valor];
        }
    }
}
