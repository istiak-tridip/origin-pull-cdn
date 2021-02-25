<?php
require_once __DIR__ . "/../vendor/autoload.php";

error_reporting(E_ALL);
ini_set("display_errors", "On");

/**
 * Get the config & requested path
 */
$config  = require __DIR__ . "/../config.php";
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/**
 * Run The Application
 */
(new \App\Response($config))->send($urlPath);
