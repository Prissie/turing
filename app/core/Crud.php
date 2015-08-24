<?php
namespace app\core;
use app\core\Database as Database;

class Crud
{
	private $db;

	public function __construct(){
		$this->db = new Database();
		$this->db->doConnect();
	}
}