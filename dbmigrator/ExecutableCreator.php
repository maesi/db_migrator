<?php
namespace dbmigrator;

class ExecutableCreator {
	
	static function create($directory) {
		$executables = array();
		if ($handle = opendir($directory)) {
		    while (false !== ($file = readdir($handle))) {
		        if ($file != "." && $file != "..") {
		            array_push($executables, new SqlFileExecutor($directory . "/" . $file));
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