<?php 
	class Database{

		private $hostName;
		private $userName;
		private $password;
		private $dbName;

		private $conn;

		public function connect(){
			$this->hostName = "localhost";
			$this->userName = "root";
			$this->password = "";
			$this->dbName = "rest_php_api";

			$this->conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
			if ($this->conn->connect_errno) {
				print_r($this->conn->connect_error);
				exit();
			} else {
				return $this->conn;
			}

		}

	}

	// $db = new Database();
	// $db->connect();

?>