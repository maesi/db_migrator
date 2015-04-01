<?php
namespace logger;

abstract class AbstractWriter implements Writer {
	
	private $minLevel;
	
	function __construct(Level $minLevel) {
		$this->minLevel = $minLevel;
	}
	
	function checkLevel(Level $logLevel) {
		return $logLevel->isGreater($this->minLevel);
	}
	
}