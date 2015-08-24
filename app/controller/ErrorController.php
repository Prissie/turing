<?php

namespace app\controller;

use app\controller\BaseController as BaseController;

Class ErrorController extends BaseController {

	public function Index() {
		$this->view->render('error/index');
	}
	
}
