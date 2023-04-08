<?php

namespace Controller;

defined('ROOTPATH') OR exit('Access Denied!');

//Trait Controller {
	
	// view pages
// 	public function view($name) {
// 		$filename = "../app/views/" . $name . ".view.php";
// 		if (file_exists($filename)) {
// 			// code...
// 			require $filename;
// 		} else {
// 			$filename = "../app/views/404.view.php";
// 			require $filename;
// 		}
// 	}
// }


Trait Controller {
	
	// view pages
	public function view($name, $data = []) {
		if (!empty($data)) {
			// code...
			// extract data if not empty
			extract($data);
		}

		$filename = "../app/views/" . $name . ".view.php";
		if (file_exists($filename)) {
			// code...
			require $filename;
		} else {
			$filename = "../app/views/404.view.php";
			require $filename;
		}
	}
}
