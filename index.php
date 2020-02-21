<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('./helpers/autoload.php');

use Request\Request;
$request = new Request();

$actionRequest = $request->getAction();
$parameters = $request->getParameters();

$action = new $actionRequest($parameters);