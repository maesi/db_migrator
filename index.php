<?php
include 'stub.php';

use dbmigrator\DBMigrator;
use logger\Logger;
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