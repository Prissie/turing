<?php

/**
* Class for: Configuration
* Load any configuration inside config.ini
*/

namespace app\core;

class Config {

	private $configs = array();

	/**
     * Load and set values of configurations
	 * @param $filename name of arquive has inside configurations
	 */
	public function load($filename) {
		if (!file_exists($filename)) {
			return sprintf(
				'[Turing] Ops! File of configurations not found in "%s"', $filename
			);
		}
		$configs = parse_ini_file($filename, true);

		foreach ($configs as $name => $properties) {
			$name = trim($name);
			$this->set($name, $properties);
		}

	}

	/**
	 * @param $name  section of value like - database, email these things.
	 * @param $properties  name of value
	 */
	public function set($name, $properties) {
		foreach ($properties as $prop => $val) {
			$this->configs[$name][$prop] = $val;
		}
	}

	/**
	 * @param $name section of value
	 * @param $properties name of value
	 * @return mixed return configuration
	 */
	public function get($name, $properties) {
		if (!isset($this->configs[$name][$properties])) {
			return sprintf(
				'[Turing] Configuration not found for:  "%s"', $name
			);
		}

		return $this->configs[$name][$properties];
	}
}