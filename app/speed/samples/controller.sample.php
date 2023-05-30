<?php

namespace Controller;

// avoiding accessing controller directly
defined('ROOTPATH') OR exit('Access Denied!');

/**
 * {CLASSNAME} Class
 */
class {CLASSNAME} {
	use Controller;

	public function index() {

		$this->view('{classname}');
	}
}

