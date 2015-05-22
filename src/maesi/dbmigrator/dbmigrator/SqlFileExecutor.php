<?php
namespace dbmigrator;

use logger\Logger;

class SqlFileExecutor extends AbstractFileExecutor {
	
	function executeInternal(DB $database) {
		$database->execute($this->content);
	}
}