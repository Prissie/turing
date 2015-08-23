<?php

/**
 * Turing
 * Small Framework For Basic Applications.
 * @author Ronaldo Rodrigues
 * @link https://github.com/RonaldoRodrigues
 * @license http://opensource.org/licenses/MIT MIT License
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

require "../app/core/Autoload.php";

use app\core\Application as Application;

$application = new Application();

?>