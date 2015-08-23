<?php
/*
*	Classe BandoDados
*   Cria novas conexões para o sistema
*/
class BancoDados
{
	private static $fabrica;
	private $bancoDados;

	/*
	* Instacia uma nova conexão no banco de dados.
	* A utilização deve ser feita por: 
	* $conexao = BancoDados::fabricarConexao()->pegarConexao();
	* @return a instacia
	*/
	public static function fabricarConexao() {
		if (!self::$fabrica) {
			self::$fabrica = new BancoDados();
		}
		return self::$fabrica;
	}

	/*
	* Cria uma nova conexão com o banco e retorna.
	* @return a conexão
	*/

	public function pegarConexao() {
		if (!$this->bancoDados) {
			$opcoes = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
			$this->bancoDados = new PDO(
				Config::pegar('DB_TIPO') . ':host=' . Config::pegar('DB_HOST') . ';dbname=' .
				Config::pegar('DB_NOME') . ';port=' . Config::pegar('DB_PORTA') . ';charset=' . Config::pegar('DB_CHARSET'),
				Config::pegar('DB_USUARIO'), Config::pegar('DB_SENHA'), $opcoes
			);
		}
		return $this->bancoDados;
	}
}