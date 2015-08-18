<?php
/*
*  Classe Login.
*  Está classe serve para ser o modelo das conexões e transações do banco de dados 
*  relacionados a login  e toda parte de login e logout.
*/

class LoginModelo
{

    /*
    * Cuida da parte de login do sistema.
    */
	public static function login($email, $senha, $lembrar = null)
    {
        // Crio uma nova validação
    	$validar = new Validacao();
    	$validar->setarCampo($email, 'email')->email(); // Verifico se o campo é um e-mail.
    	$validar->setarCampo($senha, 'senha')->obrigatorio(); // Defino que é um campo obrigatorio o preenchimento.

      	if(!$validar->validar()){ // Efetua a validação de erros.
      	 	$validar->pegarErros(); // Pega os erros e retorna no Visor em método renderMensagens().
            return false;
        }

        // Retorno com os dados do usuário
        $resultado = Self::validarPegarUsuario($email,$senha);

        // Se for vazio retorna false
        if(!$resultado){
            return false;
        }

        // Verifica o ultimo login falho e reseta para 0, caso tiver.
        if ($resultado->ultimo_login_falho > 0) {
            self::resetarContagemLogin($resultado->email);
        }

        // Salva o novo login.
        self::salvarUltimoLogin($resultado->email);
      	
        // Grava informações no cookie caso seja selecionada a opção.
        if ($lembrar) {
            self::lembrarBancoCookie($resultado->id);
        }

        // Grava as informações na sessão.
        self::loginEfetuadoSucesso(
            $resultado->id, $resultado->nome, $resultado->email, $resultado->tipo_conta
        );

        return true;
    }

    // Login através do cookie.
    public static function cookieLogin($cookie)
    {
        if (!$cookie) {
            Sessao::adicionar('erro', Mensagens::pegar('COOKIE_INVALIDO'));
            return false;
        }

       
        list ($id, $token, $hash) = explode(':', $cookie);
        if ($hash !== hash('sha256', $id . ':' . $token) OR empty($token)) {
            Sessao::adicionar('erro', Mensagens::pegar('COOKIE_INVALIDO'));
            return false;
        }

        $resultado = UsuarioModelo::pegarUsuarioPorCookie($id, $token);
        
        if ($resultado) {
          
            self::loginEfetuadoSucesso(
                $resultado->id, $resultado->nome, $resultado->email, $resultado->tipo_conta
            );


            self::salvarUltimoLogin($resultado->email);

            Sessao::adicionar('sucesso', Mensagens::pegar('LOGIN_EFETUADO_SUCESSO'));
            return true;
        } else {
            Sessao::adicionar('erro', Mensagens::pegar('COOKIE_INVALIDO'));
            return false;
        }
    }

    /*
    * Faz a validação de acessos do usuário.
    */
    private static function validarPegarUsuario($email, $senha)
    {
        // Retorna com as informações do usuário através do e-mail.
        $resultado = UsuarioModelo::pegarUsuarioPorEmail($email);

        // Verifica se possui esses dados.
        if (!$resultado) {
            Sessao::adicionar('erro', Mensagens::pegar('LOGIN_FALHO'));
            return false;
        }
        // Verifica a quantidade de logins com a senha errada. 
        if (($resultado->login_falhos >= 3) AND ($resultado->ultimo_login_falho > (time() - 30))) {
            Sessao::adicionar('erro', Mensagens::pegar('SENHA_FALHA_3_VEZES'));
            return false;
        }

        // Verifica a senha digita no sistema com a função php password_verify.
        if (!password_verify($senha, $resultado->senha_hash)) {
                self::incrementarLoginFalho($resultado->email);
                Sessao::adicionar('erro', Mensagens::pegar('SENHA_ERRADA'));
                return false;
        }

        // Verifica se a conta está ativa.
        if ($resultado->ativo != 1) {
            Sessao::adicionar('erro', Mensagens::pegar('CONTA_NAO_ATIVA'));
            return false;
        }

        return $resultado;
    }

    /*
    * Inicia a sessão do usuário no app.
    */
    public static function loginEfetuadoSucesso($id, $nome, $email, $tipo_conta)
    {
        Sessao::iniciar();
        Sessao::setar('id', $id);
        Sessao::setar('nome', $nome);
        Sessao::setar('email', $email);
        Sessao::setar('tipo_conta', $tipo_conta);
        Sessao::setar('logado', true);
    }

    /*
    * Incrementa login falho no sistema.
    */
    public static function incrementarLoginFalho($email)
    {
        Crud::update('usuarios','email', $email, ['login_falhos' => 'login_falhos+1','ultimo_login_falho' => time()]);
    }

    /*
    * Reseta a contagem do login.
    */
    public static function resetarContagemLogin($email)
    {
        Crud::update('usuarios','email', $email, ['login_falhos' => '0','ultimo_login_falho' => null]);
    }

    /*
    * Salva o ultimo login no banco de dados.
    */
    public static function salvarUltimoLogin($email)
    {
        Crud::update('usuarios','email', $email, ['ultimo_login' => time()]);
    }

    /*
    * Grava informações do cookie no sistema.
    */
    public static function lembrarBancoCookie($id)
    {
       
        $token = hash('sha256', mt_rand());
        Crud::update('usuarios','id', $id, ['lembrar' => $token ]);
       
        $cookie = $id . ':' . $token;
        $cookie_hash = hash('sha256', $cookie);
        $cookieFinal = $cookie . ':' . $cookie_hash;

        setcookie('lembrar', $cookieFinal, time() + Config::pegar('TEMPO_COOKIE'), Config::pegar('CAMINHO_COOKIE'));
    }

	/*
	* Verifica se o usuário está logado.
	*/
	public static function estaLogado()
    {
        return Sessao::checar();
    }

    /*
	* Deleta o cookie salvo no servidor.
	*/
    public static function deletarCookie()
    {
        setcookie('lembrar', false, time() - (3600 * 24 * 3650), Config::pegar('CAMINHO_COOKIE'));
    }

    /*
	* Efetua o logout na página.
	*/
    public static function logout()
    {
        self::deletarCookie();
        Sessao::destruir();
    }

}