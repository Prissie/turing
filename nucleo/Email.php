<?php

class Email
{

	private $erro;
	
	// Classe para enviar email
	public function enviarEmail($email, $de_email, $de_nome, $assunto, $corpo)
	{
		// Usamos phpmailer para enviar o email.
		if (Config::pegar('EMAIL_SERVICO') == "phpmailer") {
			return $this->enviarPHPMailer($email, $de_email, $de_nome, $assunto, $corpo);
		}

		// pode ser implementados outros serviços aqui.

	}

	// Classe que realmente envia o email utilizando o instaciamento do phpmailer.
	public function enviarPHPMailer($email, $de_email, $de_nome, $assunto, $corpo)
	{
		$classeEmail = new PHPMailer;

		
		if (Config::pegar('EMAIL_SMTP')) {
			
			$classeEmail->IsSMTP();
			$classeEmail->SMTPDebug = 0;
			$classeEmail->IsHTML(true);
			$classeEmail->CharSet = "utf8";
			$classeEmail->SMTPAuth = Config::pegar('EMAIL_SMTP_AUTENTICACAO');
			
			if (Config::pegar('EMAIL_SMTP_ENCRIPITACAO')) {
				$classeEmail->SMTPSecure = Config::pegar('EMAIL_SMTP_ENCRIPITACAO');
			}
		
			$classeEmail->Host = Config::pegar('EMAIL_SMTP_HOST');
			$classeEmail->Username = Config::pegar('EMAIL_SMTP_USUARIO');
			$classeEmail->Password = Config::pegar('EMAIL_SMTP_SENHA');
			$classeEmail->Port = Config::pegar('EMAIL_SMTP_PORTA');
		} else {
			$classeEmail->IsMail();
		}

	
		$classeEmail->From = $de_email;
		$classeEmail->FromName = $de_nome;
		$classeEmail->AddAddress($email);
		$classeEmail->Subject = $assunto;
		$classeEmail->Body = $corpo;

		$classeEmail->Send();

		if ($classeEmail) {
			return true;
		} else {
			
			$this->erro = $classeEmail->erroInfo;
			return false;
		}
	}


	// Retorna os erros
	public function pegarErro()
	{
		return $this->erro;
	}
}
