<?php
namespace logger;

class FileWriter implements Writer {

	private $filename;

	function __construct($filename) {
		$this->filename = $filename;
	}

	function write($message) {
		$content = file_get_contents($this->filename);
		$content .= $message;
		file_put_contents($this->filename, $content);
	}
}
?>