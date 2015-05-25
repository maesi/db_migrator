<?php

class Autoloader {
	
	private static $throwsException = false;
	
	static function register() {
		spl_autoload_register(array(@self, 'load'));
	}
	
	static function load($name) {
		$include = DB_MIGRATOR_ROOT . "src" . DIRECTORY_SEPARATOR . "maesi" . DIRECTORY_SEPARATOR . "dbmigrator" . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $name) . ".php";
		if(file_exists($include)) {
			include ($include);
		}
	}
}