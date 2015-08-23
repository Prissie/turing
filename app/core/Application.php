<?php

/**
 * Class for: Application
 * Load any configuration inside config.ini
 */

namespace app\core;

use app\controller as Controller;
use App\core\Request as Request;

class Application {

	private $controller;
	private $parameters = array();
	private $controllerName;
	private $actionName;

	public function __construct() {
		$this->splitUrl();
		$this->makeControllerAndAction();
		$this->turingStart();
	}

	private function splitUrl() {
		if (Request::get('url')) {
			$url = trim(Request::get('url'), '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			
			$this->controllerName = isset($url[0]) ? $url[0] : null;
			$this->actionName = isset($url[1]) ? $url[1] : null;

			unset($url[0], $url[1]);

			$this->parameters = array_values($url);
		}
	}

	private function error() {
		$this->controller = new Controller\ErrorController();
		$this->controller->Index();
	}

	private function turingStart() {
		if (file_exists(Request::pathController() . $this->controllerName . '.php')) {
			require Request::pathController() . $this->controllerName . '.php';
			if (class_exists('app\\Controller\\' . $this->controllerName)) {
				$parents = class_parents('app\\Controller\\' . $this->controllerName);
				if (in_array('app\controller\BaseController', $parents)) {
					$obj = 'app\\Controller\\' . $this->controllerName;
					$this->controlador = new $obj();
					if (method_exists($this->controlador, $this->actionName)) {
						if (!empty($this->parameters)) {
							call_user_func_array(array($this->controlador, $this->actionName), $this->parameters);
						} else {
							return $this->controlador->{$this->actionName}();
						}
					} else {
						$this->error();
					}
				}
			} else {
				$this->error();
			}
		} else {
			$this->error();
		}
	}

	private function makeControllerAndAction() {
		if (!$this->controllerName) {
			$this->controllerName = 'Index';
		}
		if (!$this->actionName OR (strlen($this->actionName) == 0)) {
			$this->actionName = 'Index';
		}
		$this->controllerName = ucwords($this->controllerName) . 'Controller';
	}

}