<?php
namespace dbmigrator;

use exception\ClassNotFoundException;

class DBFactory {

	static function create(array $configuration) {
		$clazzName = $configuration['type'];
		try {
			$clazz = new \ReflectionClass($clazzName);
			return $clazz->newInstance($configuration);
		} catch(ClassNotFoundException $nfex) {
			throw new \Exception("DB-Type $clazzName not supported");
		}
	}
}

?>