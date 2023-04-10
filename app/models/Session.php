<?php


/**
 * session class
 * save or read data to the current session
 */

namespace Core;

defined('ROOTPATH') OR exit('Access Denied!');

class Session {
	public $mainkey = 'APP';
	public $userkey = 'USER';

	// Activate session if not yet started
	private function start_session():int {
		// code...
		if (session_status() === PHP_SESSION_NONE) {
			// code...
			session_start();
		}

		return 1;
	}

	// Put data into session
	// eg:
	// No more somthing like; $_SESSION['key'] = 'value';
	// But rather; set('key', 'value');
	public function set(mixed $keyOrArray, mixed $value = ''):int {
		$this->start_session();

		if (is_array($keyOrArray)) {
			// code...
			foreach ($keyOrArray as $key => $value) {
				// code...
				$_SESSION[$this->mainkey][$key] = $value;
			}

			return 1;
		}

		$_SESSION[$this->mainkey][$keyOrArray] = $value;

		return 1;
	}

	// Get data from the session.
	// Default is return if data is not found
	// eg;
	// echo get('kofi', 'ama');
	public function get(string $key, mixed $default = ''):mixed {
		$this->start_session();

		if (isset($_SESSION[$this->mainkey][$key])) {
			// code...
			return $_SESSION[$this->mainkey][$key];
		}

		return $default;
	}

	// Save the user row data into session after login
	public function auth(mixed $user_row):int {
		$this->start_session();

		$_SESSION[$this->userkey] = $user_row;
		return 0;

	}

	// Remove user data from the session
	public function logout():int {
		$this->start_session();

		if (!empty($_SESSION[$this->userkey])) {
			// code...
			unset($_SESSION[$this->userkey]);
		}
		return 0;
	}

	// Check if user is logged in
	public function is_logged_in():bool {
		$this->start_session();

		if (!empty($_SESSION[$this->userkey])) {
			// code...
			return true;
		}

		return false;
	}

	// Check if user is an admin
	// public function is_admin():bool {
	// 	$this->start_session();
	// 	$db = new\Core\Database();

	// 	if (!empty($_SESSION[$this->userkey])) {
	// 		// code...
	// 		$arr = [];
	// 		$arr['id'] = $_SESSION[$userkey]->role_id;

	// 		if ($db->get_row("SELECT * FROM auth_roles WHERE id = :id AND role = 'admin' LIMIT 1", $arr)) {
	// 			// code...
	// 			return true;
	// 		}
	// 	}

	// 	return false;
	// }
	
	// Gets data from a column in the session user data
	// eg: echo user('email');
	public function user(string $key = '', mixed $default = ''):mixed {
		$this->start_session();

		if (empty($key) && !empty($_SESSION[$this->userkey])) {
			// code...
			return $_SESSION[$this->userkey];
		} else if (!empty($_SESSION[$this->userkey]->$key)) {
			// code...
			return $_SESSION[$this->userkey]->$key;
		}
		
		return $default;
	}

	// returns data from a key and deletes it
	public function pop(string $key, mixed $default = ''):mixed {
		$this->start_session();

		if (!empty($_SESSION[$this->mainkey][$key])) {
			// code...
			$value = $_SESSION[$this->mainkey][$key];
			unset($_SESSION[$this->mainkey][$key]);
			return $value;
		}

		return $default;
	}

	// Return all the data from the main array
	public function all():mixed {
		$this->start_session();

		if (isset($_SESSION[$this->mainkey])) {
			// code...
			return $_SESSION[$this->mainkey];
		}

		return [];
	}
}