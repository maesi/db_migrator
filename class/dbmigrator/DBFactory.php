<?php
namespace dbmigrator;

class DBFactory {

	static function create($type) {
		switch(strtolower($type)) {
			case strtolower('MySQL'):
				return new MySQL("localhost", "root", "root");
			default:
				throw new \Exception("DB-Type $type not supported");
		}
	}
}

?>