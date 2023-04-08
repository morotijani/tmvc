<?php

namespace Model;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Main Model Trait
 */
Trait Model {
	use Database;

	protected $limit 		= 10;
	protected $offset 		= 0;
	protected $order_type 	= 'DESC';
	protected $order_column = 'id';
	public $errors 		= [];


	// return all row
	// eg; findAll();
	public function findAll() {
		$query = "
			SELECT * FROM $this->table 
			ORDER BY $this->order_column $this->order_type 
			LIMIT $this->limit 
			OFFSET $this->offset
		";
		return $this->query($query);
	}

	// return multiple row with a where cluase
	// eg; where(['id' => 1])
	public function where($data, $data_not = []) {
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "SELECT * FROM $this->table WHERE ";
		foreach ($keys as $key) {
			// code...
			$query .= $key . " = :" . $key . " AND ";
		}

		foreach ($keys_not as $key) {
			// code...
			$query .= $key . " != " . $key . " AND ";
		}
		$query = trim($query, " AND ");
		$query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
		$data = array_merge($data, $data_not);

		return $this->query($query, $data);
	}

	// get first element
	public function findFirst($data, $data_not = []) {
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "SELECT * FROM $this->table WHERE ";
		foreach ($keys as $key) {
			// code...
			$query .= $key . " = :" . $key . " AND ";
		}

		foreach ($keys_not as $key) {
			// code...
			$query .= $key . " != " . $key . " AND ";
		}
		$query = trim($query, " AND ");
		$query .= " LIMIT $this->limit OFFSET $this->offset";
		$data = array_merge($data, $data_not);

		$result = $this->query($query, $data);
		if ($result) 
			// return first data
			return $result[0];

		return false;
	}

	// 	insert data into database table
	// 	eg;
	// 	$arr['name'] = 'mary';
	//	$arr['age'] = 60;
	//	insert($arr);
	public function insert($data) {
		
		// remove unwanted data
		if (!empty($this->allowedColumns)) {
			// code...
			foreach ($data as $key => $value) {
				// code...
				if (!in_array($key, $this->allowedColumns)) {
					// delete item from the list of data because is not part of the allowed columns so it shouldn't be part of the query
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);

		$query = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (:" . implode(",:", $keys) . ")";
		$this->query($query, $data);

		// not expecting any result
		return false;
	}

	// update database table
	// update with different column if not with the id column
	public function update($id, $data,  $id_column = 'id') {
		// remove unwanted data
		if (!empty($this->allowedColumns)) {
			// code...
			foreach ($data as $key => $value) {
				// code...
				if (!in_array($key, $this->allowedColumns)) {
					// delete item from the list of data because is not part of the allowed columns so it shouldn't be part of the query
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		$query = "UPDATE $this->table SET ";
		foreach ($keys as $key) {
			// code...
			$query .= $key . " = :" . $key . ", ";
		}
		$query = trim($query, ", ");
		$query .= " WHERE $id_column = :$id_column ";
		
		$data[$id_column] = $id;
		$this->query($query, $data);
		
		return false;
	}

	// delete from database table
	// eg; delete(2);
	// delete with different column if not with the id column
	// eg; delete(2, 'user_id')
	public function delete($id, $id_column = 'id') {
		$data[$id_column] = $id;
		$query = "DELETE FROM $this->table WHERE $id_column = :$id_column ";
		$this->query($query, $data);

		return false;
	}

}

