<?php
if(strcmp(php_sapi_name(),'cli') == 0 && isset($argv[1])) {
	$file = $argv[1];
	print_r($argv);
} else if(isset($_GET['file'])) {
	$file = $_GET['file'];
} else {
	$file = 'db_migrator.phar';
}
$newline = strcmp(php_sapi_name(),'cli') == 0 ? PHP_EOL : "<br />";
$pharFile = __DIR__.DIRECTORY_SEPARATOR.$file;
if(file_exists($pharFile)) {
	echo "delete existing phar".$newline;
	unlink($pharFile);
}

echo "create phar: $pharFile".$newline;
$phar = new Phar($pharFile);

$Directory = new RecursiveDirectoryIterator(__DIR__.DIRECTORY_SEPARATOR);
$Iterator = new RecursiveIteratorIterator($Directory);
$pattern = '/^' . preg_quote(__DIR__.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR) . '(src|config).+\.\w+$/i';
$Regex = new RegexIterator($Iterator, $pattern, RecursiveRegexIterator::GET_MATCH);
foreach($Regex as $name => $object){
	$name = str_replace(__DIR__.DIRECTORY_SEPARATOR, '', $name);
	echo "add file: $name".$newline;
	$phar->addFile($name);
}
echo "add stub".$newline;
$phar->setStub(file_get_contents('stub.php'));
echo "finish".$newline;
