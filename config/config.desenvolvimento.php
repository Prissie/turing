<?php


/*
* Serve para mostrar todos os erros do sistema.
* @Link http://php.net/manual/pt_BR/errorfunc.configuration.php
* @Link http://php.net/manual/pt_BR/function.error-reporting.php
*/
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Retorna uma array com as configurações
return array(


	// A URL do sistema é diretamente setada pelo servidor.
	'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),

	// Caminho dos arquivos de controler e os views.
	'CAMINHO_CONTROLADOR' => realpath(dirname(__FILE__).'/../') .'/controladores/',
	'CAMINHO_VISOR' => realpath(dirname(__FILE__).'/../') . '/views/',

	// Controlador e ação padrão do sistema.
	'DEFAULT_CONTROLADOR' => 'index',
	'DEFAULT_ACAO' => 'index',

	// Configuração para o banco de dados.
	'DB_TIPO' => 'mysql',
	'DB_HOST' => '127.0.0.1',
	'DB_NOME' => 'turing',
	'DB_USUARIO' => 'root',
	'DB_SENHA' => '',
	'DB_PORTA' => '3306',
	'DB_CHARSET' => 'utf8',

	// 
	'TEMPO_COOKIE' => 1209600,
	'CAMINHO_COOKIE' => '/',

	// Configuração para o e-mail

	'EMAIL_SERVICO' => 'phpmailer',
	'EMAIL_SMTP' => true,
	'EMAIL_SMTP_HOST' => 'smtp.gmail.com',
	'EMAIL_SMTP_AUTENTICACAO' => true,
	'EMAIL_SMTP_USUARIO' => 'gmail@gmail.com',
	'EMAIL_SMTP_SENHA' => 'gmail',
	'EMAIL_SMTP_PORTA' => 465,
	'EMAIL_SMTP_ENCRIPITACAO' => 'ssl',


	/*
	// Configuração para utilizar o email personalizado da hospedagem
	'EMAIL_USED_MAILER' => 'phpmailer',
	'EMAIL_USE_SMTP' => true,
	'EMAIL_SMTP_HOST' => 'mail.localhost.com.br',
	'EMAIL_SMTP_AUTH' => true,
	'EMAIL_SMTP_USERNAME' => 'webmaster@localhost.com.br',
	'EMAIL_SMTP_PASSWORD' => 'webmaster',
	'EMAIL_SMTP_PORT' => 465,
	'EMAIL_SMTP_ENCRYPTION' => 'ssl',
	*/


    //Configuração básica dos emails.

	// 
	'EMAIL_RESETAR_SENHA_URL' => 'login/validarsenha',
	'EMAIL_RESETAR_SENHA' => 'no-reply@turing-examplo.com',
	'EMAIL_RESETAR_SENHA_NOME' => '[Turing]',
	'EMAIL_RESETAR_SENHA_ASSUNTO' => '[Turing] Pedido de reset da senha em sua conta',
	'EMAIL_RESETAR_SENHA_CONTEUDO' => 'Por favor, clique no link ao lado: ',

	'EMAIL_VERIFICAR_URL' => 'login/validar',
	'EMAIL_VERIFICAR' => 'no-reply@turing-examplo.com',
	'EMAIL_VERIFICAR_NOME' => '[Turing]',
	'EMAIL_VERIFICAR_ASSUNTO' => '[Turing] Informações referente ao seu login',
	'EMAIL_VERIFICAR_CONTEUDO' => 'Por favor, clique no link ao lado: ',
	
);
