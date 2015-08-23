<?php

/*
* Classe IndexControlador
* Nessa classe que fazemos a rota básica do sistema.
*/
class IndexControlador extends Controlador
{

 
    public function __construct()
    {
        parent::__construct();
    }

   	// exemplo.com/index/index
    public function index()
    {
        $this->Visualizar->render('index/index');
    }
}
