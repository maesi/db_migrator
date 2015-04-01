<?php
namespace logger;

class ConsoleWriter implements Writer {

	function write($message) {
		echo self::format($message) . "<br />";
	}

	private static function format($string) {
		$string = str_replace("\t", "    ", $string);
		$string = str_replace(" ", "&nbsp;", $string);
		$string = str_replace("\n", "<br />", $string);
		return $string;
	}
}
?>