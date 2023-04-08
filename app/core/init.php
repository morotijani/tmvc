<?php 

// if a class is called but does not exists then load it
spl_autoload_register(function($className) {
	$filename = "../app/models/" . ucfirst($className) . ".php";
	require $filename;
});

// Every file in the core folder is loaded here
require ("config.php");
require ("functions.php");
require ("Database.php");
require ("Model.php");
require ("Controller.php");
require ("App.php");
