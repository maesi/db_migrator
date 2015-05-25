<?php
namespace maesi\dbmigrator;

interface DB {

	function execute($statement);
}