<?php

namespace Model;

defined('ROOTPATH') OR exit('Access Denied!');

Trait Database {

	// Database connection
	private function connect() {
		$driver = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME;
		$conn = new \PDO($driver, DBUSER, DBPASS);
		return $conn;
	}

	// all basic sql's
	public function query($query, $data = []) {
		$conn = $this->connect();
		$statement = $conn->prepare($query);
		$check = $statement->execute($data);
		if ($check) {
			// code...
			$result = $statement->fetchAll(\PDO::FETCH_OBJ);
			if (is_array($result) && count($result)) {
				// code...
				return $result;
			}
		}
		return false;
	}

	// get only one row record
	public function getRow($query, $data = []) {
		$conn = $this->connect();
		$statement = $conn->prepare($query);
		$check = $statement->execute($data);
		if ($check) {
			// code...
			$result = $statement->fetchAll(\PDO::FETCH_OBJ);
			if (is_array($result) && count($result)) {
				// code...
				return $result[0];
			}
		}
		return false;
	}

}
