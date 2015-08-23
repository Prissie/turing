<?php


class RegistroControlador extends Controlador
{
   
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	if (LoginModelo::estaLogado()) {
            Redirecionar::para('painel/login');
        } else {
             $this->Visualizar->render('registro/index');  
        }
          
    }

    public function novaconta()
    {
    	$sucesso = RegistroModelo::novoUsuario(Requisitar::post('nome'),Requisitar::post('email'),Requisitar::post('senha'),Requisitar::post('csenha'));

        if ($sucesso) {
            Redirecionar::para('login/index');
        } else {
            $this->Visualizar->render('registro/index');  
        }
    }



  
}
