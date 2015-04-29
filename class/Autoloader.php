<?php

class Autoloader {
	
	private static $throwsException = false;
	
	static function register() {
		spl_autoload_register(array(@self, 'load'));
	}

	static function setThrowsException($throwsException) {
		self::$throwsException = $throwsException;	
	}
	
	static function load($name) {
		$include = DB_MIGRATOR_ROOT."class" . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $name) . ".php";
		if(file_exists($include)) {
			include ($include);
		} else if(self::$throwsException) {
			throw new exception\ClassNotFoundException("Class $name nonexistent.");
		}
	}
}