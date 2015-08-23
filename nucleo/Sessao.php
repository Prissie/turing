<?php

/*
* Classe Sessão.
* Serve para atribuir sessões e cuidar de toda a parte.
*/

class Sessao
{

    // Inicia de formas simples a sessão. 
    public static function iniciar()
    {
        if (session_id() == '') {
            session_start();
        }
    }

    // Adiciona novas sessões. 
    public static function adicionar($valor, $registro)
    {
        $_SESSION[$valor][] = $registro;
    }

    // Destroi as sessões. 
    public static function destruir()
    {
        session_destroy();
    }

    // Verifica se o usuário está logado. 
    public static function checar()
    {
        return (self::pegar('logado') ? true : false);
    }

    // Atribui os novos valores da sessão. 
    public static function setar($valor, $registro)
    {
        $_SESSION[$valor] = $registro;
    }

    // Retorna com os valores da sessão. 
    public static function pegar($valor)
    {
        if (isset($_SESSION[$valor])) {
            return $_SESSION[$valor];
        }
    }

}
