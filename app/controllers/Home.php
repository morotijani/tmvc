<?php

namespace Controller;

// avoiding accessing controller directly
defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Home Class
 */
class Home {
	use Controller;

	public function index() {

		// Check if user is logged in or not
		// $ses = new \Core\Session;
		// if (!$ses->is_logged_in()) {
		// 	redirect('login');
		// }

		$this->view('home');
	}
}

