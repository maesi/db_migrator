<?php
namespace maesi\dbmigrator;

use Monolog\Registry;

class Logger {

	public static function debug($message) {
		if(Registry::hasLogger('dbmigrator')) {
			Registry::getInstance('dbmigrator')->addDebug($message);
		}
	}

	public static function info($message) {
		if(Registry::hasLogger('dbmigrator')) {
			Registry::getInstance('dbmigrator')->addInfo($message);
		}
	}

	public static function warning($message) {
		if(Registry::hasLogger('dbmigrator')) {
			Registry::getInstance('dbmigrator')->addWarning($message);
		}
	}

	public static function error($message) {
		if(Registry::hasLogger('dbmigrator')) {
			Registry::getInstance('dbmigrator')->addError($message);
		}
	}
}