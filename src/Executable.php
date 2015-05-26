<?php
namespace maesi\dbmigrator;

interface Executable {

	function getVersion();

	function getHash();
	
	function execute(DB $database);

}
?>