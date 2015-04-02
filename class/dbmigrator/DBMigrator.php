<?php
namespace dbmigrator;

class DBMigrator {
	
	private $database;
	
	function __construct() {
		$this->configure();
	}
	
	function migrate() {
		$this->createDatabaseStructure();
		
		$this->executeScripts();
	}

	private function configure() {
		// TODO: read from config file
		$this->database = DBFactory::create('MySQL');
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