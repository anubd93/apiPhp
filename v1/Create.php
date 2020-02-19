<?php
include_once ("../config/Database.php");
include_once ("../classes/Student.php");

$db = new Database();
$connection = $db->connect();

$student =  new Students($connection);




if ($_SERVER['REQUEST_METHOD'] === "POST" ) {
	$student->name = "ABC";
	$student->email = "abc@xyz.com";
	$student->mobile = "123456789";

// var_dump($student); exit;

	if ($student->createData()) {
		echo "Student has been created";
	} else {
		echo "Failed to insert data";
	}

} else {
	echo "Access denied";
}

?>