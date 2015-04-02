<?php
namespace dbmigrator;

class DBMigrator {
	
	private $database;
	
	function __construct(array $configuration) {
		$this->configure($configuration);
	}
	
	function migrate() {
		$this->createDatabaseStructure();
		
		$this->executeScripts();
	}

	private function configure($configuration) {
		// TODO: read from config file
		$this->database = DBFactory::create($configuration);
	}
	
	private function createDatabaseStructure() {
		$create_database_sql = file_get_contents('config/create_database.sql');
		$this->database->execute($create_database_sql);
		
		$create_table_sql = file_get_contents('config/create_table.sql');
		$this->database->execute($create_table_sql);
	}
	
	private function executeScripts() {
		foreach(ExecutableCreator::create('testdata') as $sql) {
			$sql->execute($this->database);
		}
	}
	
}