<?php
namespace logger;

abstract class AbstractWriter implements Writer {
	
	private $minLevel;
	
	function __construct(array $configuration) {
		$this->minLevel = Level::fromName($configuration['level']);
	}
	
	function checkLevel(Level $logLevel) {
		return $logLevel->isGreater($this->minLevel);
	}
	
}