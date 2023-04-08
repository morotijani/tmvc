<?php

/**
 * User class
 */
class User {
	
	use Model;

	protected $table = 'users';

	protected $allowedColumns = [
		'email',
		'password',
	];

	public function validate($data) {
		$this->errors = [];

		if (empty($data['email'])) {
			// code...
			$this->errors['email'] = 'Email is required.';
		} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['email'] = 'Email is not valid.';
		}

		if (empty($data['password'])) {
			// code...
			$this->errors['email'] = 'Password is required.';
		}

		if (empty($data['terms'])) {
			// code...
			$this->errors['email'] = 'Please accept the terms and conditions.';
		}

		if (empty($this->errors)) {
			// code...
			return true;
		}

		return false;
	}
}