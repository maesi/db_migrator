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
use dbmigrator\DBMigrator;

Logger::addWriter(new ConsoleWriter(Level::info()));
Logger::addWriter(new FileWriter(Level::warning(), "log.txt"));

$dbmigrator = new DBMigrator();
$dbmigrator->migrate();
?>