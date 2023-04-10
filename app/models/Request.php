<?php

/**
 * Request class
 * Gets and set data in a POST and GET global variables
 */

namespace Core;

defined('ROOTPATH') OR exit('Access Denied!');

class Request {
	
	// Check which post method was used
	// eg;
	// if (method() == 'POST') {}
	public function method():string {
		// code...
		return $_SERVER['REQUEST_METHOD'];
	}

	// Check if somthing was posted
	// eg;
	// instead of: if ($_SERVER['REQUEST_METHOD'] == "POST") {} or if ($_POST) {}
	// we do: posted(); and it return a bool
	public function posted():bool {
		if ($_SERVER['REQUEST_METHOD'] == "POST" && count($_POST) > 0) {
			// code...
			return true;
		}

		return false;
	}

	// Get value from a POST variable
	// eg;
	// post->('email'); return the email value;
	public function post(string $Key = '', mixed $default = ''):mixed {
		if (empty($key)) {
			// code...
			return $_POST;
		} else if (isset($_POST[$key])) {
			return $_POST[$key];
		}

		return $default;
	}

	// Get value from a FILES variable
	public function files(string $key = '', mixed $default = ''):mixed {
		if (empty($key)) {
			// code...
			return $_FILES;
		} else if (isset($_FILES[$key])) {
			return $_FILES[$key];
		}

		return $default;
	}

	// Retrieve value from a GET variable
	public function get(string $key = '', mixed $default = ''):mixed {
		if (empty($key)) {
			// code...
			return $_GET;
		} else if (isset($_GET[$key])) {
			return $_GET[$key];
		}

		return $default;
	}

	// Get a value from a REQUEST variable
	// when items are just posted to a POST you can use this method instead
	// eg;
	// $email = input('email');
	public function input(string $key, mixed $default = ''):mixed {
		if (isset($_REQUEST[$key])) {
			// code...
			return $_REQUEST[$key];
		}

		return $default;
	}

	// Get all values from a REQUEST variable
	public function all():mixed {
		return $_REQUEST;
	}
}
