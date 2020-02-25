<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET");


	include_once ("../config/Database.php");
	include_once ("../classes/Student.php");

	$db = new Database();
	$connection = $db->connect();

	$student =  new Students($connection);

	if ($_SERVER['REQUEST_METHOD'] === "GET") {
		$allStudents = $student->get_all_student();

		// print_r($allStudents); die();

		if ($allStudents->num_rows > 0) {

			$students["record"] = array();

			while ( $row = $allStudents->fetch_assoc()) {
				// print "<pre>";
				// print_r($row);
				// print "</pre>";

				array_push($students["record"], array(
					"id" => $row['id'],
					"name" => $row['name'],
					"email" => $row['email'],
					"mobile" => $row['mobile'],
					"status" => $row['status'],
					"created_at" => date("Y-m-d", strtotime($row['created_at'])),
				));

			}

			http_response_code(200);
			echo json_encode(array(
	         	"status" => 1,
	            "data" => $students["record"]
			));

		}

	} else {
		http_response_code(503);
		echo json_encode(array(
			"status" => 0,
			"message" => "Service unavailable"
		));
	}


?>