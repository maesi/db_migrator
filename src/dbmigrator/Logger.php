<?php
namespace maesi\dbmigrator;

use Monolog\Registry;

class Logger {

	public static function debug($message) {
		Registry::getInstance('dbmigrator')->addDebug($message);
	}
	public static function info($message) {
		Registry::getInstance('dbmigrator')->addInfo($message);
	}
	public static function warning($message) {
		Registry::getInstance('dbmigrator')->addWarning($message);
	}
	public static function error($message) {
		Registry::getInstance('dbmigrator')->addError($message);
	}
	
}