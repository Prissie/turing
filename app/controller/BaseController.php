<?php

namespace app\controller;

use app\core\Config as Config;
use app\core\Request as Request;
use app\core\Session as Session;
use app\core\View as View;

abstract class BaseController {

	public $view;

	public function __construct() {

		$config = new Config();

		if ($config->get('system', 'maintenance') == '1') {

			require Request::pathView() . 'maintenance/index.php';
			exit();

		} else {

			Session::init();

			if (!Session::check() AND Request::cookie('remember')) {
				header('location: ' . Request::url() . 'login/cookie');
			}

			$this->view = new View();
            
		}
	}
}
