<?php
namespace logger;

class FileWriter extends AbstractWriter {

	private $filename;

	function __construct(Level $minLevel, $filename) {
		parent::__construct($minLevel);
		$this->filename = $filename;
	}

	function write(Level $level, $message) {
		$content = $message;
		if(file_exists($this->filename)) {
			$content = $level . ": " . file_get_contents($this->filename) . $content;
		}
		file_put_contents($this->filename, $content);
	}
}
?>