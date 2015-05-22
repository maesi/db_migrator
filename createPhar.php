<?php
$pharFile = __DIR__.DIRECTORY_SEPARATOR.'db_migrator.phar';
if(file_exists($pharFile)) {
	echo "delete existing phar<br />";
	unlink($pharFile);
}

echo "create phar: $pharFile<br />";
$phar = new Phar($pharFile);

$Directory = new RecursiveDirectoryIterator(__DIR__.DIRECTORY_SEPARATOR);
$Iterator = new RecursiveIteratorIterator($Directory);
$pattern = '/^' . preg_quote(__DIR__.DIRECTORY_SEPARATOR) . '(class|config).+\.\w+$/i';
$Regex = new RegexIterator($Iterator, $pattern, RecursiveRegexIterator::GET_MATCH);
foreach($Regex as $name => $object){
	$name = str_replace(__DIR__.DIRECTORY_SEPARATOR, '', $name);
	echo "add file: $name<br />";
	$phar->addFile($name);
}
echo "add stub<br />";
$phar->setStub(file_get_contents('stub.php'));
echo "finish";
