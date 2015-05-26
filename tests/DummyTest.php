<?php
namespace maesi\dbmigrator\tests;

class DummyTest extends PHPUnit_Framework_TestCase
{
	public function testDummy()
	{
		Logger::info('d');
		$this->assertTrue(true);
	}
}
?>