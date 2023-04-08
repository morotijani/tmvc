<?php

namespace Controller;

// avoiding accessing controller directly
defined('ROOTPATH') OR exit('Access Denied!');

class _404 {
	use Controller;
	
	public function index() {
		echo "404 Page not found controller";
	}
}


