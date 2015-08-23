<?php


class PainelControlador extends Controlador
{
   
    public function __construct()
    {
        parent::__construct();
        Autenticacao::Checar();
    }

    public function index()
    {

        $this->Visualizar->render('painel/index');
        
    }


  
}
