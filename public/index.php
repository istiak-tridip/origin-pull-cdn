<?php
require_once __DIR__ . "/../vendor/autoload.php";

error_reporting(E_ALL);
ini_set("display_errors", "On");

/**
 * Get the config & requested path without the query string
 */
$config  = require __DIR__ . "/../config.php";
$urlPath = str_replace("?" . $_SERVER['QUERY_STRING'], "", $_SERVER['REQUEST_URI']);

/**
 * Run The Application
 */
(new \App\Response($config))->send($urlPath);
