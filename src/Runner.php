<?php
namespace maesi\dbmigrator;

class Runner {

	public static function fromConfig(array $config) {
		Logger::info('DBMigrator Version ' . DB_MIGRATOR_VERSION);
		
		try {
			$dbmigrator = new DBMigrator($config['db.connection']);
			$dbmigrator->migrate($config['src']['directory']);
		} catch(\Exception $ex) {
			Logger::error($ex);
		}
	}
}
