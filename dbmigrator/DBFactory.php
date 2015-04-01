<?php
namespace dbmigrator;

class DBFactory {
	
	private static $instance;
	
	static function create() {
		if(self::$instance == null) {
			self::$instance = new MySQL("localhost","root","root");
		}
		return self::$instance;
	}
}

?>