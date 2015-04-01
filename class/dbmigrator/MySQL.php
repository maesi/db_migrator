<?php
namespace dbmigrator;

use logger\Logger;
use logger\Level;

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
			Logger::info($stmt);
			if(!$this->mysqli->query($stmt)) {
				Logger::error($this->mysqli->errno . ":" . $this->mysqli->error);
			}
		}
	}
}

?>