<?php
namespace logger;

final class Level {
	
	static function debug() {
		return new Level(1, "debug");
	}
	
	static function info() {
		return new Level(2, "info");
	}
	
	static function warning() {
		return new Level(3, "warning");
	}
	
	static function error() {
		return new Level(4, "error");
	}
	
	static function fromName($name) {
		$refMethod = new \ReflectionMethod('logger\Level', $name);
		return $refMethod->invoke(null);
	}
	
	private $level;
	private $message;
	
	private function __construct($level, $message) {
		$this->level = $level;
		$this->message = $message;
	}
	
	function isGreater(Level $level) {
		return $this->level >= $level->level; 
	}
	
	function __toString() {
		return $this->message;
	}
	
}