<?php
spl_autoload_register('autoload');

function autoload($classname) {

	$classname = ltrim($classname, '\\');
	$filename = '';
	$filename .= str_replace('_', '/', $classname) . '.php';

	require '../'.$filename;
	
}
