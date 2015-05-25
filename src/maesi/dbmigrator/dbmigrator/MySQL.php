<?php
namespace dbmigrator;

class MySQL implements DB {

	private $mysqli;

	public function __construct(array $configuration) {
		$this->mysqli = new \mysqli($configuration['host'], $configuration['username'], $configuration['password'], $configuration['database']);
	}

	function execute($statement) {
		$statements = preg_split("/;/", $statement);
		$this->startTransaction();
		foreach($statements as $stmt) {
			$stmt = trim($stmt) . ";";
			if($stmt == ";") {
				continue;
			}
			Logger::debug($stmt);
			if(!$result = $this->mysqli->query($stmt)) {
				$this->rollback();
				throw new \Exception($this->mysqli->errno . ":" . $this->mysqli->error);
			}
			if(@$result->num_rows > 0) {
				return $result->fetch_object();
			}
		}
		$this->commit();
	}
	
	private function startTransaction() {
		$this->mysqli->autocommit(FALSE);
		Logger::debug('startTransaction');
	}
	
	private function commit() {
		$this->mysqli->commit();
		$this->mysqli->autocommit(TRUE);		
		Logger::debug('commit');
	}
	
	private function rollback() {
		$this->mysqli->rollback();
		$this->mysqli->autocommit(TRUE);
		Logger::debug('rollback');
	}
}

?>