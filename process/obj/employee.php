<?php

	class Employee
	{

		public $conn;

		public 
			$emp_id, 
			$emp_password, 
			$emp_fname, 
			$emp_mname, 
			$emp_lname, 
			$emp_email, 
			$emp_contact,
			$emp_datetime, 
			$emp_pos_title,
			$emp_image,
			$emp_hire_date,
			$emp_status;

		function __construct($db)
		{
			$this->conn = $db;
		} // function ends

		function getAllFrontliner()
		{
			$query = "SELECT * 
					FROM employee_account 
					WHERE employee_position_title = 'Frontliner'
					AND employee_status = 'Active'";

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

		function getAllSupervisor()
		{
			$query = "SELECT * 
					FROM employee_account 
					WHERE employee_position_title = 'Supervisor'
					AND employee_status = 'Active'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getEmployee($id)
		{
			$query = "SELECT * 
					FROM employee_account 
					WHERE employee_id = '$id'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function getEmployeeUsingEmpId($empid)
		{
			$query = "SELECT * 
					FROM employee_account 
					WHERE employee_id = '$empid'";

			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function updateEmployeeProfileUsingEmpId($empid)
		{
			$query = "UPDATE employee_account
						SET employee_fname=:employee_fname,
							employee_mname=:employee_mname,
						 	employee_lname=:employee_lname,
						 	employee_contact=:employee_contact,
						 	employee_email=:employee_email
						WHERE employee_id = '$empid'";

			$stmt = $this->conn->prepare($query);
			
			$this->emp_fname = htmlspecialchars(strip_tags($this->emp_fname));
			$this->emp_mname = htmlspecialchars(strip_tags($this->emp_mname));
			$this->emp_lname = htmlspecialchars(strip_tags($this->emp_lname));
			$this->emp_contact = htmlspecialchars(strip_tags($this->emp_contact));
			$this->emp_email = htmlspecialchars(strip_tags($this->emp_email));

			$stmt->bindParam(':employee_fname', $this->emp_fname);
			$stmt->bindParam(':employee_mname', $this->emp_mname);
			$stmt->bindParam(':employee_lname', $this->emp_lname);
			$stmt->bindParam(':employee_contact', $this->emp_contact);
			$stmt->bindParam(':employee_email', $this->emp_email);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

		function updateEmployeePasswordUsingEmpId($empid, $newpass)
		{
			$query = "UPDATE employee_account
						SET
							employee_password=:employee_password
						WHERE employee_id = '$empid'";

			$stmt = $this->conn->prepare($query);
			
			$this->emp_password = htmlspecialchars(strip_tags($this->emp_password));

			$stmt->bindParam(':employee_password', $this->emp_password);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}
		} //function ends

	
	} // class ends


?>
