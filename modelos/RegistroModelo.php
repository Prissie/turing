<?php
/*
*  Classe Registro.
*  Está classe serve para ser o modelo das conexões e transações do banco de dados 
*  relacionados a novo usuario e toda parte de registro.
*/

class RegistroModelo
{
	public static function novoUsuario($nome,$email,$senha,$csenha)
	{

		// Crio uma nova validação
    	$validar = new Validacao();
    	$validar->setarCampo($nome, 'nome')->obrigatorio(); 
        $validar->setarCampo($email, 'email')->email(); 
        $validar->setarCampo($senha, 'senha')->obrigatorio(); 
        $validar->setarCampo($senha, 'senha', $csenha)->comparar(); 

      	if(!$validar->validar()){ // Efetua a validação de erros.
      	 	$validar->pegarErros(); // Pega os erros e retorna no Visor em método renderMensagens().
            return false;
        }

        // Criamos um hash da senha do usuário.
		$senha_hash = password_hash($senha, PASSWORD_DEFAULT);


		// Verificamos se o usuário já está cadastrado
		if (UsuarioModelo::pegarUsuarioPorEmail($email)) {
			Sessao::adicionar('erro', Mensagens::pegar('EMAIL_JA_CADASTRADO'));
			return false;
		}

		// Criamos um hash para ativação da conta.
		$hash = sha1(uniqid(mt_rand(), true));

		if (!self::salvarNovoUsuario($nome, $senha_hash, $email, time(), $hash)) {
			Sessao::adicionar('erro', Mensagens::pegar('CRICAO_CONTA_FALHA'));
		}

		// Verificamos se foi efetuado o cadastro.
		$resultado = UsuarioModelo::pegarUsuarioPorEmail($email);

		if (!$resultado->id) {
			Sessao::adicionar('erro', Mensagens::pegar('ERRO_DESCONHECIDO'));
			return false;
		}

		// send verification email
		if (self::enviarEmailCadastro($resultado->id, $email, $hash)) {
			Sessao::adicionar('sucesso',  Mensagens::pegar('CONTA_CRIADA'));
			return true;
		}

		// Caso ocorra um erro ao enviar o email, cancelamos o cadastro.
		self::cancelarUsuario($resultado->id);
		Sessao::adicionar('erro', Mensagens::pegar('ERRO_DESCONHECIDO'));
		return false;
	}

	// Envia o email de forma simples, para o cadastro do cliente.
    public static function enviarEmailCadastro($id, $email, $hash)
    {

        $corpo = Config::pegar('EMAIL_VERIFICAR_CONTEUDO') . ' ' . Config::pegar('URL') .
                Config::pegar('EMAIL_VERIFICAR_URL') . '/' . urlencode($id) . '/' . urlencode($hash);

       
        $classeEmail = new Email;

        $enviado = $classeEmail->enviarEmail($email, Config::pegar('EMAIL_VERIFICAR'), 
            Config::pegar('EMAIL_VERIFICAR_NOME'), Config::pegar('EMAIL_VERIFICAR_ASSUNTO'), $corpo
        );

        if ($enviado) {
            Sessao::adicionar('sucesso', Mensagens::pegar('CRIAR_EMAIL_SUCESSO'));
            return true;
        }

        Sessao::adicionar('erro', Mensagens::pegar('CRIAR_EMAIL_FALHO') . $classeEmail->pegarErro());
        return false;
    
    }

    // Checa as condições, é se foi criada uma nova conta, retorna verdadeiro
	public static function salvarNovoUsuario($nome, $senha_hash, $email, $data, $hash)
    {

        if(self::gravarNovaUsuario($nome, $senha_hash, $email, $data, $hash)){
            return true;
        }else{
            return false;
        }

    }

    // Grava um novo usuário no banco de dados
    public static function gravarNovaUsuario($nome, $senha_hash, $email, $data, $hash)
    {
    	return Crud::inserir('usuarios',['nome' => $nome, 'senha_hash' => $senha_hash, 
    									'email' => $email, 'data_criacao' => $data, 
    									'ativacao_hash' => $hash]);

    }

    // Faz a verificação da conta para ativar
    public static function verificarCodigo($id, $codigo)
    {

    	if(Crud::update('usuarios','id',$id,['ativo' => 1,'ativacao_hash' => NULL])){
    		Sessao::adicionar('sucesso', Mensagens::pegar('ATIVAR_CONTA_SUCESSO'));
    		return true;
    	}else{
    		Sessao::adicionar('erro', Mensagens::pegar('ATIVAR_CONTA_FALHO'));
    		return false;
    	}

    }
    // Serve de roolback na registração de um novo usuario
    public static function cancelarUsuario($id)
    {
    	Crud::deletar('usuarios','id',$id);
    }


}