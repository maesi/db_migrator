<?php
use exception\ClassNotFoundException;

function __autoload($name) {
	$include = "class/" . str_replace("\\", "/", $name) . ".php";
	if(!file_exists($include)) {
		throw new ClassNotFoundException("Class $name nonexistent.");
	}
	include ($include);
}

use dbmigrator\DBMigrator;
use logger\ConsoleWriter;
use logger\FileWriter;
use logger\Logger;
use logger\Level;
use logger\WriterFactory;

$config = parse_ini_file('dbmigrator.ini', true);

try {
	if(@$config['logger']['enabled']) {
		$writers = explode(',', $config['logger']['enabled']);
		foreach($writers as $writer) {
			$keyName = "logger.writer.".trim($writer);
			Logger::addWriter(WriterFactory::create($config[$keyName]));
		}
	}
	
	$dbmigrator = new DBMigrator($config['db.connection']);
	$dbmigrator->migrate();
} catch(Exception $ex) {
	Logger::error($ex);
}
?>