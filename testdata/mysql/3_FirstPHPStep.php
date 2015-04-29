<?php
use dbmigrator\Executable;
use dbmigrator\AbstractFileExecutor;
use dbmigrator\DB;
use logger\Logger;

class FirstPHPStep extends AbstractFileExecutor {

	function executeInternal(DB $database) {
		Logger::info("do something");
	}
	
}