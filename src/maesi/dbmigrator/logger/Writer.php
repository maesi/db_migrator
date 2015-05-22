<?php
namespace logger;

interface Writer {

	function write(Level $level, $message);
}
?>