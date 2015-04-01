<?php

function __autoload($name) {
	$include = "class/". str_replace("\\", "/", $name) . ".php";
	include ($include);
}
use dbmigrator\ExecutableCreator;
use dbmigrator\MySQL;
use dbmigrator\DBFactory;
use logger\ConsoleWriter;
use logger\FileWriter;
use logger\Logger;
use logger\Level;

Logger::addWriter(new ConsoleWriter(Level::info()));
Logger::addWriter(new FileWriter(Level::warning(), "log.txt"));

$database = DBFactory::create();

$create_database_sql = file_get_contents('config/create_database.sql');
$database->execute($create_database_sql);

$create_table_sql = file_get_contents('config/create_table.sql');
$database->execute($create_table_sql);

foreach(ExecutableCreator::create('testdata') as $sql) {
	$sql->execute($database);
}
?>