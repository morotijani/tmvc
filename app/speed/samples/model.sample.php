<?php

namespace Model;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * {CLASSNAME} class
 */
class {CLASSNAME} {
	
	use Model;

	// database table
	protected $table = '{table}';
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


}

