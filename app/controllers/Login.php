<?php

namespace Controller;

// avoiding accessing controller directly
defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Login Class
 */
class Login {
	use Controller;

	public function index() {
		
		$data['user'] = new \Model\User;
		$req = new \Core\Request;

		// check if something was posted
		if ($req->posted()) {
			// code...
			$data['user']->login(cleanPost($_POST)); 
		}

		$this->view('login', $data);
	}
}

