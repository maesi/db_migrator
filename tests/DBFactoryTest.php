<?php
namespace maesi\dbmigrator\tests;

use maesi\dbmigrator\DBFactory;

class DBFactoryTest extends \PHPUnit_Framework_TestCase {

	public function testCreateWithEmptyConfiguration() {
		try {
			DBFactory::create(array());
		} catch(\Exception $ex) {
			$this->assertEquals('Undefined index: class', $ex->getMessage());
		}
	}

	public function testCreateWithNonExistingDBType() {
		$clazzName = 'DBTypeWhichNotExists';
		$arr['class'] = $clazzName;
		try {
			DBFactory::create($arr);
		} catch(\Exception $ex) {
			$this->assertEquals("DB-Type $clazzName not supported", $ex->getMessage());
		}
	}
}