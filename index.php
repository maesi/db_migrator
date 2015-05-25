<?php
include 'stub.php';

use dbmigrator\Runner;

$config['db.connection']['name'] 			= 'mysql';
$config['db.connection']['class']			= 'dbmigrator\MySQL';
$config['db.connection']['host']			= 'localhost';
$config['db.connection']['username']		= 'root';
$config['db.connection']['password']		= 'root';
$config['db.connection']['database']		= 'dbmigrator';

$config['src']['directory']					= 'testdata';

$config['logger']['enabled']				= 'console, debugLog, infoLog, errorLog';

$config['logger.writer.console']['class']	= 'logger\ConsoleWriter';
$config['logger.writer.console']['level']	= 'debug';

$config['logger.writer.debugLog']['class']	= 'logger\FileWriter';
$config['logger.writer.debugLog']['level']	= 'debug';
$config['logger.writer.debugLog']['file']	= 'log'.DIRECTORY_SEPARATOR.'debugLog.txt';

$config['logger.writer.infoLog']['class']	= 'logger\FileWriter';
$config['logger.writer.infoLog']['level']	= 'info';
$config['logger.writer.infoLog']['file']	= 'log'.DIRECTORY_SEPARATOR.'infoLog.txt';

$config['logger.writer.errorLog']['class']	= 'logger\FileWriter';
$config['logger.writer.errorLog']['level']	= 'error';
$config['logger.writer.errorLog']['file']	= 'log'.DIRECTORY_SEPARATOR.'errorlog.txt';

Runner::fromConfig($config);
