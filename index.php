<?php

function __autoload($name) {
	$include = str_replace("\\", "/", $name) . ".php";
	include ($include);
}
use dbmigrator\ExecutableCreator;
use dbmigrator\MySQL;
use dbmigrator\DBFactory;
use logger\ConsoleWriter;
use logger\FileWriter;
use logger\Logger;

Logger::addWriter(new ConsoleWriter());
Logger::addWriter(new FileWriter("log.txt"));

$database = DBFactory::create();

$create_database_sql = file_get_contents('config/create_database.sql');
$database->execute($create_database_sql);

$create_table_sql = file_get_contents('config/create_table.sql');
$database->execute($create_table_sql);

foreach(ExecutableCreator::create('testdata') as $sql) {
	$sql->execute($database);
}
?>