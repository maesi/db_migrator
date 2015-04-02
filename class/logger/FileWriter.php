<?php
namespace logger;

class FileWriter extends AbstractWriter {

	private $filename;

	function __construct(Level $minLevel, $filename) {
		parent::__construct($minLevel);
		$this->filename = $filename;
	}

	function write(Level $level, $message) {
		if($this->checkLevel($level)) {
			$dateTime = \DateTime::createFromFormat('U.u', microtime(true));
			$content =  $dateTime->format('Y-m-d H:i:s.u') . " " . $level . ": " . $message . "\n";
			if(file_exists($this->filename)) {
				$content =file_get_contents($this->filename) . $content;
			}
			file_put_contents($this->filename, $content);
		}
	}
}
?>