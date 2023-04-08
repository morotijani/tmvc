<?php

/**
 * Home Class
 */
class Home {
	use Controller;

	public function index() {
		$this->view('home');
	}
}

