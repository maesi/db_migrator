<?php

class Autoloader {
	
	static function load($name) {
		$include = DB_MIGRATOR_ROOT."class" . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $name) . ".php";
		if(!file_exists($include)) {
			throw new exception\ClassNotFoundException("Class $name nonexistent.");
		}
		include ($include);
	}
}