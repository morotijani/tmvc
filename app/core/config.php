<?php

defined('ROOTPATH') OR exit('Access Denied!');

// check if project is on a live server or not
if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1' || $_SERVER['SERVER_NAME'] == 'sites.local') {
	// code...
	// database configuration
	define('DBNAME', 'tmvc');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');

	// Set project root path for live server
	define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/tmvc/public/');
	define('PROOT', '/tmvc/public/');
} else {
	// database configuration
	define('DBNAME', 'tmvc');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');

	// Set project root path for local server
	define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/');
	define('PROOT', '/');

}

//
define('APP_NAME', 'TMVC');
define('APP_DESC', 'TMVC a light oop mvc framework in php');

// true = show errors
// false = dont show errors
define('DEBUG', true);
