<?php

namespace Controller;

// avoiding accessing controller directly
defined('ROOTPATH') OR exit('Access Denied!');

/**
 *  Class
 */
class  {
	use Controller;

	public function index() {

		$this->view('');
	}
}

