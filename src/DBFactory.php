<?php
namespace maesi\dbmigrator;

class DBFactory {

	static function create(array $configuration) {
		$clazzName = $configuration['class'];
		try {
			$clazz = new \ReflectionClass($clazzName);
			return $clazz->newInstance($configuration);
		} catch(\ReflectionException $rex) {
		}
		throw new \Exception("DB-Type $clazzName not supported");
	}
}

?>