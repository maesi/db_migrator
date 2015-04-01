<?php
namespace dbmigrator;

interface DB {

	function execute($statement);
}