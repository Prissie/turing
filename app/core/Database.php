<?php

namespace app\core;

use app\core\Config as Config;
use PDO;

class Database {

	private  $server;
	private  $type;
	private  $database;
	private  $user;
	private  $charset;
	private  $password;
	private  $port;
	private  $db;

	public function __construct() {

		$config = new Config();

		$this->server = $config->get('database', 'host');
		$this->type = $config->get('database', 'type');
		$this->database = $config->get('database', 'database');
		$this->user = $config->get('database', 'user');
		$this->charset = $config->get('database', 'charset');
		$this->password = $config->get('database', 'password');
		$this->port = $config->get('database', 'port');

	}

	public function doConnect() {
		if (!$this->db) {

			$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
			$this->db = new PDO(
				$this->type . ':host=' . $this->server . ';dbname=' . $this->database . ';port=' . $this->port . ';charset=' .
				$this->charset, $this->user, $this->password, $options
			);
		}

		return $this->db;
	}
}