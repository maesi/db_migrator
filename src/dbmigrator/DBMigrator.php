<?php
namespace maesi\dbmigrator;

class DBMigrator {
	
	private $database;
	private $dbName;
	
	function __construct(array $configuration) {
		$this->configure($configuration);
	}
	
	function migrate($directory) {
		$this->createDatabaseStructure();
		$this->executeScripts($directory);
	}

	private function configure($configuration) {
		$this->database = DBFactory::create($configuration);
		$this->dbName = $configuration['name'];
	}
	
	private function createDatabaseStructure() {
		$create_table_sql = file_get_contents(DB_MIGRATOR_ROOT.'config'.DIRECTORY_SEPARATOR.$this->dbName.DIRECTORY_SEPARATOR.'create_table.sql');
		$this->database->execute($create_table_sql);
	}
	
	private function executeScripts($directory) {
		foreach(ExecutableCreator::create($directory.DIRECTORY_SEPARATOR.$this->dbName) as $sql) {
			$sql->execute($this->database);
		}
	}
	
}