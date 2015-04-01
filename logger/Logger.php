<?php
namespace logger;

class Logger {

	private static $writers = array();

	static function addWriter(Writer $writer) {
		array_push(self::$writers, $writer);
	}

	static function write($message) {
		foreach(self::$writers as $writer) {
			$writer->write($message);
		}
	}
}
?>