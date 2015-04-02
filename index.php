<?php

function __autoload($name) {
	$include = "class/". str_replace("\\", "/", $name) . ".php";
	include ($include);
}

use dbmigrator\DBMigrator;
use logger\ConsoleWriter;
use logger\FileWriter;
use logger\Logger;
use logger\Level;

Logger::addWriter(new ConsoleWriter(Level::info()));
Logger::addWriter(new FileWriter(Level::warning(), "log.txt"));

try {
	$dbmigrator = new DBMigrator();
	$dbmigrator->migrate();
} catch (Exception $ex) {
	Logger::error($ex);
}
?>