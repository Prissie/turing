<?php




namespace app\controller;


use app\core\Session as Session;
use app\core\View as View;
use app\core\Request as Request;
use app\core\Auth as Auth;

abstract class BaseController {
    
    public $view;

    public function __construct() {
    	
    	Session::init();

    	if (!Session::check() AND Request::cookie('remember')) {
            header('location: ' . Request::url() . 'login/cookie');
        }

    	$this->view = new View();
    }
        
  
}
