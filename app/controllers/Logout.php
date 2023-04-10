<?php

namespace Controller;

// avoiding accessing controller directly
defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Logout Class
 */
class Logout {
	use Controller;

	public function index() {
		$ses = new \Core\Session;
		$ses->logout();
		redirect('login');
	}
}

