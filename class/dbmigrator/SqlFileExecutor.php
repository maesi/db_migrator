<?php
namespace dbmigrator;

use logger\Logger;

class SqlFileExecutor extends FileExecutor {

	function execute(DB $data) {
		parent::execute($data);
		Logger::debug($this->getVersion() . " -> " . $this->getName());
		$data->execute($this->content);
	}
}