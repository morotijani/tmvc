<?php 

session_start();

// check for php version if valid
$minPHPVersion = '8.0';
if (phpversion() < $minPHPVersion) {
	// code...
	die("Your PHP version must be {$minPHPVersion} or higher to run this Framework. Your current version is " . phpversion());
}

// path to this index file
define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);

require ("../app/core/init.php");

// check for debuging mode
DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$app = new App;
$app->loadController();

