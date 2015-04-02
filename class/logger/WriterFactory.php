<?php
namespace logger;

class WriterFactory {

	static function create(array $configuration) {
		$clazzName = $configuration['class'];
		try {
			$clazz = new \ReflectionClass($clazzName);
			return $clazz->newInstance($configuration);
		} catch(ClassNotFoundException $nfex) {
			throw new \Exception("Logger-Writer $clazzName not supported");
		}
	}
}