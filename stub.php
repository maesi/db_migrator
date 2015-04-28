<?php
$extension = pathinfo(__FILE__, PATHINFO_EXTENSION);
if($extension == 'phar') {
	define("DB_MIGRATOR_ROOT", 'phar://'.__FILE__.'/');
} else {
	define("DB_MIGRATOR_ROOT", dirname(__FILE__).'/');
}
require_once DB_MIGRATOR_ROOT.'class/Autoloader.php';
spl_autoload_register('\Autoloader::load');
__HALT_COMPILER();