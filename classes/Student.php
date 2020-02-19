<?php 
	class Students{

		public $name; 
		public $email;
		public $mobile;

		private $conn; 
		private $table_name;

		public function __construct($db){
			$this->conn = $db;
			$this->table_name = "tbl_students";	
		}

		public function createData(){

			// insert query

			$query = "INSERT INTO " . $this->table_name . "SET name = ?, email = ?, mobile = ?";
			// var_dump($this->conn); exit();
			$obj = $this->conn->prepare($query);
			// var_dump($obj); exit();

			// sanitize input data

			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->email = htmlspecialchars(strip_tags($this->email));
			$this->mobile = htmlspecialchars(strip_tags($this->mobile));

			$obj->bind_param("sss" , $this->name, $this->email, $this->mobile);

			if ($obj->execute()) {
				return true;
			} 

			return false;

		}

	}
?>