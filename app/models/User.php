<?php

namespace Model;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * User class
 */
class User {
	
	use Model;

	// database table
	protected $table = 'users';
	// database table primary key to use
	protected $primaryKey = 'id';
	// database table unique column you like to use for checks on login
	protected $loginUniqueColumn = 'email';

	// database table table allowed columns
	protected $allowedColumns = [
		'username',
		'email',
		'password',
	];

	// columns that are allowed to be validated
	/*************************************
	 * rules include
	 *required 
	 *alpha 
	 *alpha_space
	 *alpha_numeric
	 *alpha_numeric_symbol
	 *alpha_symbol
	 *email 
	 *numeric 
	 *unique 
	 *symbol 
	 *not_less_than_6_chars
	 * **************************/
	protected $validationRules = [
		'email' => [ 
			'email', 
			'unique',
			'required', 
		],
		'username' => [
			'alpha', 
			'required', 
		],
		'password' => [
			'not_less_than_6_chars', 
			'required', 
		],
	];
	
	// sign user up
	public function signup($data) {
		if ($this->validate($data)) {
			// add extra columns here
			$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			$data['date'] = date('Y-m-d H:i:s A');
			$data['date_created'] = date('Y-m-d H:i:s A');
			
			$this->insert($data);
			redirect('login');
		}
	}

	// log user in
	public function login($data) {
		$row = $this->findFirst([$this->loginUniqueColumn => $data[$this->loginUniqueColumn]]);

		if ($row) {
			// code...
			// confirm password
			if (password_verify($data['password'], $row->password)) {
				$ses = new \Core\Session;
				$ses->auth($row);
				redirect('home');
			} else {
				$this->errors[$this->loginUniqueColumn] = 'Wrong ' . $this->loginUniqueColumn . ' or password!';
			}
		} else {
			$this->errors[$this->loginUniqueColumn] = 'Wrong ' . $this->loginUniqueColumn . ' or password!';
		}
	}

}

