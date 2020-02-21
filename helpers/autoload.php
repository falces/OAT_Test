<?php
spl_autoload_register(function($className) {
    $dir = dirname(__DIR__) . '/classes/';
	$className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
	include_once $dir . $className . '.php';
});
