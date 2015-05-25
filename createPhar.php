<?php
$file = 'db_migrator.phar';
$version = 'local';
if(strcmp(php_sapi_name(),'cli') == 0) {
	$newline = PHP_EOL;
	if(isset($argv[1])) {
		$file = $argv[1];
	}
	if(isset($argv[2])) {
		$version = $argv[2];
	}
} else {
	$newline = "<br />";
	if(isset($_GET['file'])) {
		$file = $_GET['file'];
	}
	if(isset($_GET['version'])) {
		$version = $_GET['version'];
	}
}

$pharFile = __DIR__.DIRECTORY_SEPARATOR.$file;
if(file_exists($pharFile)) {
	echo "delete existing phar".$newline;
	unlink($pharFile);
}

echo "create phar: $pharFile (version: $version)".$newline;
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
$stub_content = str_replace("#DB_MIGRATOR_VERSION_PLACEHOLDER#", $version, file_get_contents('stub.php'));
$phar->setStub($stub_content);
echo "finish".$newline;
