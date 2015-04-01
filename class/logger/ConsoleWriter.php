<?php
namespace logger;

class ConsoleWriter extends AbstractWriter {

	function write(Level $level, $message) {
		if($this->checkLevel($level)) {
			echo $level . ": " . self::format($message) . "<br />";
		}
	}

	private static function format($string) {
		$string = str_replace("\t", "    ", $string);
		$string = str_replace(" ", "&nbsp;", $string);
		$string = str_replace("\n", "<br />", $string);
		return $string;
	}
}
?>