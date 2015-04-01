<?php
namespace dbmigrator;

abstract class FileExecutor implements Executable {

	protected $file;
	protected $content;
	
	function __construct($file) {
		$this->file = $file;
		$this->readContent();
	}

	function getVersion() {
		$filename = $this->getFilename();
		return substr($filename, 0, strpos($filename, "_"));
	}
	
	function getName() {
		$filename = $this->getFilename();
		return substr($filename, strpos($filename, "_")+1, strrpos($filename, ".") - strpos($filename, "_")-1);
	}
	
	private function getFilename() {
		if(strrpos($this->file, "/")) {
			return substr($this->file, strrpos($this->file, "/") + 1);
		} else {
			return $this->file;
		}
	}
	
	private function readContent() {
		$this->content = file_get_contents($this->file);
	}
	
	public function getHash() {
		return sha1_file($this->file, true);
	}
	
	public function execute(DB $database) {
		$sql = '
			INSERT INTO _migration (version, name, checksum) 
			VALUES ("'.$this->getVersion().'", "'.$this->getName().'", "'.$this->getHash().'");
		';
		$database->execute($sql);
	}
}	
?>