<?php
$extension = pathinfo(__FILE__, PATHINFO_EXTENSION);
if($extension == 'phar') {
	define("DB_MIGRATOR_ROOT", 'phar://'.__FILE__.'/');
} else {
	define("DB_MIGRATOR_ROOT", dirname(__FILE__).'/');
}
define("DB_MIGRATOR_VERSION", '#DB_MIGRATOR_VERSION_PLACEHOLDER#');
require_once DB_MIGRATOR_ROOT.'src/maesi/dbmigrator/Autoloader.php';
\Autoloader::register();
__HALT_COMPILER();