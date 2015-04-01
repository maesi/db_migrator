<?php
namespace dbmigrator;

use logger\Logger;

class MySQL implements DB {

	private $mysqli;

	public function __construct($host, $user, $password) {
		$this->mysqli = new \mysqli($host, $user, $password);
	}

	function execute($statement) {
		$statements = preg_split("/;/", $statement);
		foreach($statements as $stmt) {
			$stmt = trim($stmt) . ";";
			if($stmt == ";") {
				continue;
			}
			Logger::write($stmt);
			if(!$this->mysqli->query($stmt)) {
				Logger::write("Error:" . $this->mysqli->errno . ":" . $this->mysqli->error);
			}
			Logger::write("\n");
		}
	}
}

?>