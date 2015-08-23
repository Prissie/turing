<?php

/*
* Classe Redirecionar
* Serve para redirecionar usuários.
* Utilize Redirecionar::para() ou Redirecionar::home() ;
*/

class Redirecionar
{

	public static function home()
	{
		header("location: " . Config::pegar('URL').'login/index');
	}


	public static function para($caminho)
	{
		header("location: " . Config::pegar('URL') . $caminho);
	}
}