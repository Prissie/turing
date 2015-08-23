<?php


class UsuariosControlador extends Controlador
{
   
    public function __construct()
    {
        parent::__construct();
        Autenticacao::Checar();
    }

    public function index()
    {

        $this->Visualizar->render('usuario/index',array('usuarios' => UsuarioModelo::pegarTodosUsuarios()));
        
    }

    public function mostrarPerfil($id)
    {

        $this->Visualizar->render('usuario/mostrarperfil', array('usuario' => UsuarioModelo::pegarUsuarioPorId($id) ));
        
    }

    public function json(){

    	Visor::Json(UsuarioModelo::pegarTodosUsuarios());
    	
    }


  
}
