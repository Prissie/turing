<?php
/*
*  Classe Senha.
*  Está classe serve para ser o modelo das conexões e transações do banco de dados 
*  relacionados a senha e recuperção.
*/

class SenhaModelo
{
	// Retorna com todos dados do usuário através do email.
	public static function requisitarNovaSenha($email)
    {

        // Crio uma nova validação
        $validar = new Validacao();
        $validar->setarCampo($email, 'email')->email(); // Verifico se o campo é um e-mail.

        if(!$validar->validar()){ // Efetua a validação de erros.
            $validar->pegarErros(); // Pega os erros e retorna no Visor em método renderMensagens().
            return false;
        }
       

         // Retorna com as informações do usuário através do e-mail.
        $resultado = UsuarioModelo::pegarUsuarioPorEmail($email);

        // Se for vazio retorna false
        if(!$resultado){
            Sessao::adicionar("erro", Mensagens::pegar('USUARIO_NAO_EXISTE'));
            return false;
        }

        // Cria um reset Hash
        $reset_hash = sha1(uniqid(mt_rand(), true));


        // Cria um novo token para recuperar a senha
        $token = self::setarResetToken($resultado->email, $reset_hash, time());
        if (!$token) {
            return false;
        }

        // Envia o email com o token
        $email = self::enviarEmailRecuperacao($resultado->email, $reset_hash);

        if ($email) {
            return true;
        }
        return false;
    }

    // Faz update e grava o token para resetar a senha
    public static function setarResetToken($email, $reset_hash, $data)
    {
        if(Crud::update('usuarios', 'email', $email, ['reset_hash' => $reset_hash, 'reset_hash_data' => $data ])){
            return true;
        }else{
            Sessao::adicionar('erro', Mensagens::pegar('OCORREU_UM_ERRO_RESET'));
            return false;
        }
    }

    // Envia o email de recuperacao
    public static function enviarEmailRecuperacao($email, $reset_hash)
    {

        $corpo = Config::pegar('EMAIL_RESETAR_SENHA_CONTEUDO') . ' ' . Config::pegar('URL') .
                Config::pegar('EMAIL_RESETAR_SENHA_URL') . '/' . urlencode($email) . '/' . urlencode($reset_hash);

       
        $classeEmail = new Email;

        $enviado = $classeEmail->enviarEmail($email, Config::pegar('EMAIL_RESETAR_SENHA'), 
            Config::pegar('EMAIL_RESETAR_SENHA_NOME'), Config::pegar('EMAIL_RESETAR_SENHA_ASSUNTO'), $corpo
        );

        if ($enviado) {
            Sessao::adicionar('sucesso', Mensagens::pegar('RESET_EMAIL_SUCESSO'));
            return true;
        }

        Sessao::adicionar('erro', Mensagens::pegar('RESET_EMAIL_FALHO') . $classeEmail->pegarErro());
        return false;
    
    }

    // Gravamos uma nova senha para o usuario
    public function gravarNovaSenha($email, $hash, $reset_hash)
    {
       return Crud::update('usuarios','reset_hash', $reset_hash, ['senha_hash' => $hash, 'reset_hash' => NULL, 'reset_hash_data' => NULL]);
    }

    public static function salvarNovaSenha($email, $reset_hash, $senha, $csenha)
    {
      // Crio uma nova validação
        $validar = new Validacao();
        $validar->setarCampo($email, 'email')->email(); // Verifico se o campo é um e-mail.
        $validar->setarCampo($senha, 'senha', 20)->tamanhoMaximo(); 
        $validar->setarCampo($senha, 'senha', $csenha)->comparar(); 

        if(!$validar->validar()){ // Efetua a validação de erros.
            $validar->pegarErros(); // Pega os erros e retorna no Visor em método renderMensagens().
            return false;
        }
        // Criamos um hash aqui da nova senha
        $hash = password_hash($senha, PASSWORD_DEFAULT);

        if(self::gravarNovaSenha($email,$hash,$reset_hash)){
            Sessao::adicionar('sucesso', Mensagens::pegar('RESET_SENHA_SUCESSO'));
            return true;
        }else{
            Sessao::adicionar('erro', Mensagens::pegar('RESET_SENHA_FALHO'));
            return false;
        }

    }


    // Verificamos o codigo para ver se é valido
    public static function verificarCodigo($email, $codigo)
    {
        $resultado = Crud::acharPor('usuarios','reset_hash', $codigo);

        if (!$resultado) {
            Sessao::adicionar('erro', Mensagens::pegar('RESET_NAO_EXISTE'));
            return false;
        }

        $tempo = time() - 3600;
        // Verifica o tempo do email
        if ($resultado->reset_hash_data > $tempo) {
            Sessao::adicionar('sucesso',  Mensagens::pegar('RESET_LINK_VALIDO'));
            return true;
        } else {
             Sessao::adicionar('erro',  Mensagens::pegar('RESET_LINK_INVALIDO'));
            return false;
        }
    }



}