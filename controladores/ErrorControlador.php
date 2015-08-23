<?php


class ErrorControlador extends Controlador
{
   
    public function __construct()
    {
        parent::__construct();
    }

   
    public function index()
    {
        $this->Visualizar->render('error/index');
    }
}
