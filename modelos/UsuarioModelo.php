<?php
/*
*  Classe Usuario.
*  Está classe serve para ser o modelo das conexões e transações do banco de dados 
*  relacionados ao usuario, toda a parte sobre usuários.
*/

class UsuarioModelo
{
	// Retorna com todos dados do usuário através do email.
	public static function pegarUsuarioPorEmail($email)
    {
    	$resultado = Crud::acharPor('usuarios','email', $email);
    	return $resultado;
    }

    // Retorna com todos dados do usuário através do email.
    public static function pegarUsuarioPorId($id)
    {
        $resultado = Crud::acharPor('usuarios','id', $id);
        return $resultado;
    }

    // Retorna com todos dados dos usuários
    public static function pegarTodosUsuarios()
    {
        $resultado = Crud::todos('usuarios');
        return $resultado;
    }

	// Retorna com todos dados do usuário através do token
    public static function pegarUsuarioPorCookie($token)
    {

    	$resultado = Crud::acharComLimit('usuarios','lembrar', $token, '1');
        return $resultado;
    }


}