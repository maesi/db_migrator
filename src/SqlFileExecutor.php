<?php
namespace maesi\dbmigrator;

class SqlFileExecutor extends AbstractFileExecutor {
	
	function executeInternal(DB $database) {
		$database->execute($this->content);
	}
}