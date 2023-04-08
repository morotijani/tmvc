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
		$this->view('home');
	}
}

