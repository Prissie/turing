<?php

namespace app\core;
use app\core\Session as Session;
use app\core\Request as Request;

class Auth
{


    public static function check()
    {
    
        Session::init();

        if (!Session::check()) {
           
            Session::destroy();
            header('location: ' . Request::url() . 'login');
            exit();
        }
    }
}
