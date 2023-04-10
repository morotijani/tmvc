<?php

namespace Controller;

// avoiding accessing controller directly
defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Signup Class
 */
class Signup {
	use Controller;

	public function index() {
		
		$data['user'] = new \Model\User;
		$req = new \Core\Request;
		
		// check if something was posted
		if ($req->posted()) {
			// code...
			$data['user']->signup(cleanPost($_POST)); 
		}

		$this->view('signup', $data);
	}
}

