<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
function show_r($sameVal)
{
	echo "<pre>";
		print_r($sameVal);
	echo "</pre>";
}