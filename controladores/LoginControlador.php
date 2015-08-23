<?php


class LoginControlador extends Controlador
{
   
    public function __construct()
    {
        parent::__construct();
    }

    // exemplo.com/login/index
    public function index()
    {
        if (LoginModelo::estaLogado()) {
            Redirecionar::para('painel/login');
        } else {
            $this->Visualizar->render('login/index');
        }
        
    }
    
    // exemplo.com/login/login
    public function login()
    {

        $sucesso = LoginModelo::login(
            Requisitar::post('email'), Requisitar::post('senha'), Requisitar::post('lembrar')
        );

        
       if ($sucesso) {
            Redirecionar::para('painel/index');
        } else {
            Redirecionar::para('login/index');
        }
      
    }


    public function resetar()
    {
      $this->Visualizar->render('login/resetar');
    }

    public function resetarSenha()
    {
        $resultado = SenhaModelo::requisitarNovaSenha(Requisitar::post('email'));
        if($resultado){
            Redirecionar::para('login/index');
        }else{
            $this->Visualizar->render('login/resetar');
        }
        
    }

    public function validarSenha($email, $codigo)
    {
    
        if (SenhaModelo::verificarCodigo($email, $codigo)) {
     
            $this->Visualizar->render('login/mudarSenha', array(
                'email' => $email,
                'reset_hash' => $codigo
            ));
        } else {
            Redirecionar::para('login/index');
        }
    }

    public function validar($id, $codigo)
    {
        if (isset($id) && isset($codigo)) {
            RegistroModelo::verificarCodigo($id, $codigo);
            $this->Visualizar->render('login/validar');
        } else {
            Redirecionar::para('login/index');
        }
    }

    public function salvarNovaSenha()
    {

       SenhaModelo::salvarNovaSenha(Requisitar::post('email'),Requisitar::post('reset_hash'),Requisitar::post('senha'),Requisitar::post('csenha') );
       Redirecionar::para('login/index');
     
    }

    public function logout()
    {
        LoginModelo::logout();
        Redirecionar::home();
    }

    public function cookie()
    {
        $sucesso = LoginModelo::cookieLogin(Requisitar::cookie('lembrar'));
        
        if ($sucesso) {
            Redirecionar::para('painel/index');
        } else {
            LoginModelo::deletarCookie();
            Redirecionar::para('login/index');
        }
    }


  
}
