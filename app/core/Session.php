<?php

namespace app\core;

class Session
{


    public static function init()
    {
        if (session_id() == '') {
            session_start();
        }
    }

    public static function add($key, $value)
    {
        $_SESSION[$key][] = $value;
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function check()
    {
        return (self::get('loggin_in') ? true : false);
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

}
