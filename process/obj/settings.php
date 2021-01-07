<?php

	class Settings
	{

		public $conn;

		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function getQA()
		{
			$query = "SELECT * 
					FROM settings_admin_table 
					WHERE settings_title = 'QA'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function  ends

		function getESC()
		{
			$query = "SELECT * 
					FROM settings_admin_table 
					WHERE settings_title = 'ESC'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function  ends

	} // class ends


?>
