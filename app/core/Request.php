<?php


namespace app\core;

class Request {

	public static function post($key, $clean = false) {
		if (isset($_POST[$key])) {
			return ($clean) ? trim(strip_tags($_POST[$key])) : $_POST[$key];
		}
	}

	public static function postCheckbox($key) {
		return isset($_POST[$key]) ? 1 : NULL;
	}

	public static function get($key) {
		if (isset($_GET[$key])) {
			return $_GET[$key];
		}
	}
	public static function cookie($key) {
		if (isset($_COOKIE[$key])) {
			return $_COOKIE[$key];
		}
	}

	public static function url(){
		return 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME']));
	}

	public static function pathView(){
		return realpath(dirname(__FILE__).'/../') . '/view/';
	}

	public static function pathPublic(){
		return realpath(dirname(__FILE__).'/../../') . '/public/';
	}

	public static function pathController(){
		return realpath(dirname(__FILE__).'/../') . '/controller/';
	}

	public static function pathConfig(){
		return realpath(dirname(__FILE__).'/../../') . '/config.ini';
	}

	public static function pathLib(){
		return realpath(dirname(__FILE__).'/../../') . '/lib/';
	}



	public static function home()
	{
		header("location: " . Self::url().'index/index');
	}

	public static function to($path)
	{
		header("location: " . Self::url() . $path);
	}
}
