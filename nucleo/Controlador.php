<?php

/* 
*  Classe Controlador
*  Serve para ser extendida a aos outros controladores, 
*  nele checamos as iniamos uma sessão e criamos uma nova view. 
*/
class Controlador
{
    
    public $Visualizar;


    function __construct()
    {

        // Iniciamos a sessão
        Sessao::iniciar();

        // Se não tivemos a sessão mas tivemos um cookie, tentamos logar com o cookie
        if (!Sessao::checar() AND Requisitar::cookie('lembrar')) {
            header('location: ' . Config::pegar('URL') . 'login/cookie');
        }

        $this->Visualizar = new Visor();
    }
}
