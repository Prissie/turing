<?php

/*
*	Classe de Autenticação
*   Serve para autenticar os usuários do sistema através  Autenticacao::Checar();
*/

class Autenticacao
{

	/*
	* Checa os usuários no sistema para saber se estão logados.
	*/
    public static function Checar()
    {
    
        Sessao::iniciar();

       	// Se ele não estiver logado a sessão acabada.
        if (!Sessao::checar()) {
           
            Sessao::destruir();
            header('location: ' . Config::pegar('URL') . 'login');
          
            exit();
        }
    }
}
