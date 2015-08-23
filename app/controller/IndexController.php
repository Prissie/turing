<?php

namespace app\controller;

use app\controller\BaseController as BaseController;

Class IndexController extends BaseController {
	

	public function index(){
		$this->view->render('index/index');
	}
}


