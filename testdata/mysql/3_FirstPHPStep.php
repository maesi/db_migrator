<?php
use maesi\dbmigrator\Executable;
use maesi\dbmigrator\Logger;
use maesi\dbmigrator\AbstractFileExecutor;
use maesi\dbmigrator\DB;

class FirstPHPStep extends AbstractFileExecutor {

	function executeInternal(DB $database) {
		Logger::info("do something");
	}
	
}