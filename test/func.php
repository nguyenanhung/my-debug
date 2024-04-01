<?php
if (!function_exists('__show__')) {
	function __show__($s): void
	{
		echo "<pre>";
		print_r($s);
		echo "</pre>";
	}
}
