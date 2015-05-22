<?php
namespace logger;

class Logger {

	private static $writers = array();

	static function addWriter(Writer $writer) {
		array_push(self::$writers, $writer);
	}
	
	static function debug($message) {
		self::write(Level::debug(), $message);
	}
	
	static function info($message) {
		self::write(Level::info(), $message);
	}
	
	static function warning($message) {
		self::write(Level::warning(), $message);
	}
	
	static function error($message) {
		self::write(Level::error(), $message);
	}

	private static function write(Level $level, $message) {
		foreach(self::$writers as $writer) {
			$writer->write($level, $message);
		}
	}
}
?>