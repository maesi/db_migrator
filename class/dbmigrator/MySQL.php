<?php
namespace dbmigrator;

use logger\Logger;
use logger\Level;

class MySQL implements DB {

	private $mysqli;

	public function __construct(array $configuration) {
		$this->mysqli = new \mysqli($configuration['host'], $configuration['username'], $configuration['password'], $configuration['database']);
	}

	function execute($statement) {
		$statements = preg_split("/;/", $statement);
		foreach($statements as $stmt) {
			$stmt = trim($stmt) . ";";
			if($stmt == ";") {
				continue;
			}
			Logger::debug($stmt);
			if(!$result = $this->mysqli->query($stmt)) {
				throw new \Exception($this->mysqli->errno . ":" . $this->mysqli->error);
			}
			if(@$result->num_rows > 0) {
				return $result->fetch_object();
			}
		}
	}
}

?>