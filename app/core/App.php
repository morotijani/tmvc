<?php

defined('ROOTPATH') OR exit('Access Denied!');

class App {

	// create a default
	private $controller = 'Home';
	private $method = 'index';

	// Split url data and get what is inside
	private function splitURL() {
		$URL = $_GET['url'] ?? 'home';
		$URL = explode("/", trim($URL, "/"));
		return $URL;
	}

	// Load files 
	public function loadController() {
		$URL = $this->splitURL();

		// select controller
		$filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
		if (file_exists($filename)) {
			// code...
			require $filename;
			$this->controller = ucfirst($URL[0]);
			// after use remove from the url
			unset($URL[0]);
		} else {
			$filename = "../app/controllers/_404.php";
			require $filename;
			$this->controller = "_404";
		}

		$mycontroller = ('\Controller\\' . $this->controller);
		$controller = new $mycontroller;

		// Select method
		if (!empty($URL[1])) {
			// check if there is a specific method inside the controller
			if (method_exists($controller, $URL[1])) {
				// code...
				$this->method = $URL[1];
				// after use remove from the url
				unset($URL[1]);
			}
		}
		call_user_func_array([$controller, $this->method], $URL);
	}
}

