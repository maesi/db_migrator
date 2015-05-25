<?php
require 'vendor/autoload.php';
include 'stub.php';

use dbmigrator\Runner;
use Monolog\Logger;
use Monolog\Registry;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;

$config['db.connection']['name'] 			= 'mysql';
$config['db.connection']['class']			= 'dbmigrator\MySQL';
$config['db.connection']['host']			= 'localhost';
$config['db.connection']['username']		= 'root';
$config['db.connection']['password']		= 'root';
$config['db.connection']['database']		= 'dbmigrator';

$config['src']['directory']					= 'testdata';

$logger = new Logger('dbmigrator');
$logger->pushHandler(new BrowserConsoleHandler(), Logger::DEBUG);
$logger->pushHandler(new StreamHandler('debug.log', Logger::DEBUG));
$logger->pushHandler(new StreamHandler('info.log', Logger::INFO));
$logger->pushHandler(new StreamHandler('error.log', Logger::ERROR));
Registry::addLogger($logger, 'dbmigrator');

Runner::fromConfig($config);
