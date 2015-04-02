<?php
use exception\ClassNotFoundException;

function __autoload($name) {
	$include = "class/" . str_replace("\\", "/", $name) . ".php";
	if(!file_exists($include)) {
		throw new ClassNotFoundException();
	}
	include ($include);
}

use dbmigrator\DBMigrator;
use logger\ConsoleWriter;
use logger\FileWriter;
use logger\Logger;
use logger\Level;

$config = parse_ini_file('dbmigrator.ini', true);

Logger::addWriter(new ConsoleWriter(Level::info()));
Logger::addWriter(new FileWriter(Level::warning(), "log.txt"));

try {
	$dbmigrator = new DBMigrator($config['db.connection']);
	$dbmigrator->migrate();
} catch(Exception $ex) {
	Logger::error($ex);
}
?>