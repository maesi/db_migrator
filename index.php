<?php
$loader = require __DIR__ . "/vendor/autoload.php";
$loader->addPsr4('maesi\\', __DIR__.'/src');

use maesi\dbmigrator\Runner;
use Monolog\Logger;
use Monolog\Registry;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;

$config['db.connection']['name'] 			= 'mysql';
$config['db.connection']['class']			= 'maesi\dbmigrator\MySQL';
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
