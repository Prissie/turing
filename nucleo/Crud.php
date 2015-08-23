<?php

/*  
* Classe Crud
* Nessa classe são realizadas todas as operações com o banco de dados como: insert, update, select e delete.
* A conexão é muito simples, só adicionar  $conexao = BancoDados::fabricarConexao()->pegarConexao();
* e você terá uma conexão em pdo.
*/

class Crud
{

	/*
	* Método para retornar todos os dados de uma tabela.
	* @param string $tabela - nome da tabela para busca.
	* @return uma array com os dados
	*/
    public static function todos($tabela) {
    	 $conexao = BancoDados::fabricarConexao()->pegarConexao();
    	 $sql = "SELECT * FROM $tabela";
    	 $query = $conexao->prepare($sql);
		 $query->execute();
		 return $query->fetchAll();
    }

    /*
	* Método para retornar todos os dados de uma tabela com base no id.
	* @param string $tabela - nome da tabela para busca.
	* @param string $campo - nome do atributo para achar o dado.
	* @param mixed $valor - valor utilizado para a busca com base no atributo.
	* @return uma array com os dados
	*/
    public static function acharComLimit($tabela, $campo, $valor, $limite) {
    	 $conexao = BancoDados::fabricarConexao()->pegarConexao();
    	 $sql = "SELECT * FROM $tabela WHERE $campo = :$campo LIMIT $limite";
    	 $query = $conexao->prepare($sql);
		 $query->execute(array(":$campo" => $valor));

		 return $query->fetchAll();
    }

    /*
	* Método para retornar todos os dados de uma tabela com base no campo e valor.
	* @param string $tabela - nome da tabela para busca.
	* @param string $campo - nome do atributo para achar o dado.
	* @param mixed $valor - valor utilizado para a busca com base no atributo.
	* @return uma array com os dados
	*/
    public static function acharPor($tabela, $campo, $valor) {
    	 $conexao = BancoDados::fabricarConexao()->pegarConexao();
    	 $sql = "SELECT * FROM $tabela WHERE $campo = :$campo";
    	 $query = $conexao->prepare($sql);
		 $query->execute(array(":$campo" => $valor));
		 
		 return $query->fetch();
    }



    /*
	* Método para inserir valores em uma tabela.
	* @param string $tabela - nome da tabela para busca.
	* @param mixed array $data - valor utilizado para inserir com base na quantidade de campos.
	* @return boolean 
	*/
	public static function inserir($tabela, $data = []) {

		 $atributos = implode(',', array_keys($data));
		 $valores = "'".implode("','", $data)."'";

		 $conexao = BancoDados::fabricarConexao()->pegarConexao();
		 $sql = "INSERT INTO $tabela ($atributos) VALUES ($valores)";
		 $query = $conexao->prepare($sql);
		 $query->execute();

		 $count =  $query->rowCount();
		 if ($count == 1) {
			return true;
		 }
		return false;
	}

	  /*
	* Método para trocar valores em uma tabela.
	* @param string $tabela - nome da tabela para busca.
	* @param string $campo - nome do atributo para achar o dado.
	* @param mixed $parametro - parametro para o update.
	* @param mixed array $data - valor utilizado para inserir com base na quantidade de campos.
	* @return boolean 
	*/
	public static function update($tabela, $campo, $parametro, $data = []) {
		$setarValores = [];

		foreach ($data as $atributo => $valor) {
			$setarValores[] = "$atributo = '$valor' ";
		}

		$setarQuery = implode(',', $setarValores);
		 
		$conexao = BancoDados::fabricarConexao()->pegarConexao();
		$sql = "UPDATE $tabela SET $setarQuery WHERE $campo = :$campo";
		$query = $conexao->prepare($sql);
		$query->execute(array(":$campo" => $parametro));

		$count =  $query->rowCount();
		if ($count == 1) {
			return true;
		}
		return false;
	}

	/*
	* Método para deletar dados pela determinada tabela.
	* @param string $tabela - nome da tabela para busca.
	* @param string $campo - nome do atributo para deletar o dado.
	* @param mixed $valor - valor utilizado para a condição do delete.
	* @return boolean 
	*/
	public static function deletar($tabela,$campo, $valor) {

		$conexao = BancoDados::fabricarConexao()->pegarConexao();
		$sql = "DELETE FROM $tabela WHERE $campo = :$campo ";
		$query = $conexao->prepare($sql);
		$query->execute(array(":$campo" => $valor));

		$count =  $query->rowCount();
		if ($count > 0) {
			return true;
		 }

		return false;
	}


	

}