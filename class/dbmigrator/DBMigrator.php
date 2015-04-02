<?php
namespace dbmigrator;

class DBMigrator {
	
	private $database;
	private $dbName;
	
	function __construct(array $configuration) {
		$this->configure($configuration);
	}
	
	function migrate() {
		$this->createDatabaseStructure();
		
		$this->executeScripts();
	}

	private function configure($configuration) {
		$this->database = DBFactory::create($configuration);
		$this->dbName = $configuration['name'];
	}
	
	private function createDatabaseStructure() {
		$create_database_sql = file_get_contents('config/'.$this->dbName.'/create_database.sql');
		$this->database->execute($create_database_sql);
		
		$create_table_sql = file_get_contents('config/'.$this->dbName.'/create_table.sql');
		$this->database->execute($create_table_sql);
	}
	
	private function executeScripts() {
		foreach(ExecutableCreator::create('testdata/'.$this->dbName) as $sql) {
			$sql->execute($this->database);
		}
	}
	
}