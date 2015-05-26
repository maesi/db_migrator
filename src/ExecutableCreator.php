<?php
namespace maesi\dbmigrator;

class ExecutableCreator {
	
	static function create($directory) {
		$executables = array();
		if (is_dir($directory) && $handle = opendir($directory)) {
		    while (false !== ($file = readdir($handle))) {
		        if ($file != "." && $file != "..") {
		        	$fileWithPath = $directory . DIRECTORY_SEPARATOR . $file;
		        	$extension = pathinfo($fileWithPath, PATHINFO_EXTENSION);
		        	if($extension == 'sql') {
		        		Logger::debug("sql file ($fileWithPath) found");
		            	array_push($executables, new SqlFileExecutor($fileWithPath));
		        	} else if($extension == 'php') {
		        		Logger::debug("php file ($fileWithPath) found");
		        		include($fileWithPath);
		        		$className = AbstractFileExecutor::getNameFromFilename($file);
		        		$reflectionClass = new \ReflectionClass($className);
		        		
		        		$isExecutable = false;
		        		foreach ($reflectionClass->getInterfaceNames() as $interface) {
							if($interface == 'dbmigrator\Executable') {
								$isExecutable = true;
							}
		        		}
		        		if($isExecutable) {
		        			array_push($executables, $reflectionClass->newInstance($fileWithPath));
		        		} else {
		        			Logger::warning("class $className does not implement dbmigrator\Executable");
		        		}
		        	} else {
		        		Logger::warning("file ($fileWithPath) has unknown type ($extension)");
		        	}
		        }
		    }
		    closedir($handle);
		}
		
		self::sort($executables);
		
		return $executables;
	} 
	
	/**
	 * Sortiert die Einträge des Arrays nach der Versionsnummer
	 */
	private static function sort(array &$executables) {
		usort($executables,function($a,$b){
			return strcoll($a->getVersion(),$b->getVersion());
		});
	}
	
}
?>	