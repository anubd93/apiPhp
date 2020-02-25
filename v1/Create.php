<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-type: application/json charset: UTF-8");
	header("Access-Control-Allow-Methods: POST");


	include_once ("../config/Database.php");
	include_once ("../classes/Student.php");

	$db = new Database();
	$connection = $db->connect();

	$student =  new Students($connection);




	if ($_SERVER['REQUEST_METHOD'] === "POST" ) {

		$data = json_decode(file_get_contents("php://input"));

		if(!empty($data->name) && !empty($data->email) && !empty($data->mobile)){
				// print_r($data);die();

				$student->name = $data->name;
				$student->email = $data->email;
				$student->mobile = $data->mobile;

			// var_dump($student); exit;

				if ($student->createData()) {
					http_response_code(200);
					echo json_encode(array(
	            		"status" => 1,
	            		"message" => "Student has been created"
					));
				} else {
					http_response_code(500);
					echo json_encode(array(
	            		"status" => 0,
	            		"message" => "Failed to insert data"
					));
				}
		} else {
			http_response_code(404);
			echo json_encode(array(
	         	"status" => 0,
	            "message" => "All values needed"
			));
		}

	} else {
		http_response_code(503);
		echo json_encode(array(
			"status" => 0,
			"message" => "Access denied"
		));
	}

?>