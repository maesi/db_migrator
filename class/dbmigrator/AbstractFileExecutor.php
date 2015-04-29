<?php
namespace dbmigrator;

use logger\Logger;

abstract class AbstractFileExecutor implements Executable {

	static function getNameFromFilename($filename) {
		return substr($filename, strpos($filename, "_") + 1, strrpos($filename, ".") - strpos($filename, "_") - 1);
	}
	
	private $file;
	
	protected $content;
	
	function __construct($file) {
		$this->file = $file;
		$this->readContent();
	}
	
	function getVersion() {
		$filename = $this->getFilename();
		return substr($filename, 0, strpos($filename, "_"));
	}
	
	function getHash() {
		return sha1_file($this->file);
	}


	protected function getFilename() {
		if(strrpos($this->file, DIRECTORY_SEPARATOR)) {
			return substr($this->file, strrpos($this->file, DIRECTORY_SEPARATOR) + 1);
		} else {
			return $this->file;
		}
	}
	
	protected function alreadyExecuted(DB $database) {
		$sql = 'SELECT * FROM _migration WHERE version="' . $this->getVersion() . '"';
		$result = $database->execute($sql);
		if(count($result) > 0) {
			$messageStart = "File with Version " . $this->getVersion();
			if($result->checksum == $this->getHash()) {
				Logger::info($messageStart . " already exists");
			} else {
				Logger::warning($messageStart . " exists with different checksum");
			}
			return true;
		}
		return false;
	}
	
	protected function insertStep(DB $database) {
		$sql = 'INSERT INTO _migration (version, name, checksum)';
		$sql .= ' VALUES ("' . $this->getVersion() . '", "' . $this->getName() . '", "' . $this->getHash() . '")';
		$database->execute($sql);
	}

	private function getName() {
		return self::getNameFromFilename($this->getFilename());
	}
	
	private function readContent() {
		$this->content = file_get_contents($this->file);
	}
	
	final function execute(DB $database) {
		if(!$this->alreadyExecuted($database)) {
			Logger::info("Execute file " . $this->file);
			$this->executeInternal($database);
			$this->insertStep($database);
		}
	}
	
	abstract function executeInternal(DB $database);
	
}