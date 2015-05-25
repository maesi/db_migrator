<?php
namespace dbmigrator;

use logger\WriterFactory;
use logger\Logger;

class Runner {

	public static function fromConfig(array $config) {
		self::initLogger($config);
		Logger::info('DBMigrator Version ' . DB_MIGRATOR_VERSION);
		
		try {
			$dbmigrator = new DBMigrator($config['db.connection']);
			$dbmigrator->migrate($config['src']['directory']);
		} catch(\Exception $ex) {
			Logger::error($ex);
		}
	}

	private static function initLogger(array $config) {
		if(@$config['logger']['enabled']) {
			$writers = explode(',', $config['logger']['enabled']);
			foreach($writers as $writer) {
				$keyName = "logger.writer." . trim($writer);
				Logger::addWriter(WriterFactory::create($config[$keyName]));
			}
		}
	}
}
