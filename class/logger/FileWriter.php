<?php
namespace logger;

class FileWriter implements Writer {

	private $filename;

	function __construct($filename) {
		$this->filename = $filename;
	}

	function write($message) {
		$content = $message;
		if(file_exists($this->filename)) {
			$content = file_get_contents($this->filename) . $content;
		}
		file_put_contents($this->filename, $content);
	}
}
?>