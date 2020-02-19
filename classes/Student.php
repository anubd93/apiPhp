<?php 
	class Students{

		public $name; 
		public $email;
		public $mobile;

		private $conn; 
		private $table_name;

		public function __contruct($db){
			$this->conn = $db;
			$this->table_name = "tbl_students";	
		}

		public function createData(){

			// insert query

			$query = "INSERT INTO " . $this->table_name . "SET name = ?, email = ?, mobile = ?";
			$obj = $this->conn->prepare($query);

			// sanitize input data

			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->email = htmlspecialchars(strip_tags($this->email));
			$this->mobile = htmlspecialchars(strip_tags($this->mobile));

			$obj->bind_param("sss" , $this->name, $this->email, $this->mobile);
			if ($obj->execute()) {
				return true;
			} else {
				return false;
			}

		}

	}
?>