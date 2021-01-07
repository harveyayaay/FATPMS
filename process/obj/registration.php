<?php

	class Registration
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

		function addEmployee()
		{
			$query = 'INSERT INTO employee_account
						SET
							employee_id=:employee_id,
							employee_password=:employee_password,
							employee_fname=:employee_fname,
							employee_mname=:employee_mname,
							employee_lname=:employee_lname,
							employee_email=:employee_email,
							employee_contact=:employee_contact,
							employee_date_time_creation=:employee_date_time_creation,
							employee_position_title=:employee_position_title,
							employee_image=:employee_image,
							employee_hire_date=:employee_hire_date,
							employee_status=:employee_status';

			$stmt = $this->conn->prepare($query);

			$this->emp_id = htmlspecialchars(strip_tags($this->emp_id));
			$this->emp_password = htmlspecialchars(strip_tags($this->emp_password));
			$this->emp_fname = htmlspecialchars(strip_tags($this->emp_fname));
			$this->emp_mname = htmlspecialchars(strip_tags($this->emp_mname));
			$this->emp_lname = htmlspecialchars(strip_tags($this->emp_lname));
			$this->emp_email = htmlspecialchars(strip_tags($this->emp_email));
			$this->emp_contact = htmlspecialchars(strip_tags($this->emp_contact));
			$this->emp_datetime = htmlspecialchars(strip_tags($this->emp_datetime));
			$this->emp_pos_title = htmlspecialchars(strip_tags($this->emp_pos_title));
			$this->emp_image = htmlspecialchars(strip_tags($this->emp_image));
			$this->emp_hire_date = htmlspecialchars(strip_tags($this->emp_hire_date));
			$this->emp_status = htmlspecialchars(strip_tags($this->emp_status));

			$stmt->bindParam(':employee_id', $this->emp_id);
			$stmt->bindParam(':employee_password', $this->emp_password);
			$stmt->bindParam(':employee_fname', $this->emp_fname);
			$stmt->bindParam(':employee_mname', $this->emp_mname);
			$stmt->bindParam(':employee_lname', $this->emp_lname);
			$stmt->bindParam(':employee_email', $this->emp_email);
			$stmt->bindParam(':employee_contact', $this->emp_contact);
			$stmt->bindParam(':employee_date_time_creation', $this->emp_datetime);
			$stmt->bindParam(':employee_position_title', $this->emp_pos_title);
			$stmt->bindParam(':employee_image', $this->emp_image);
			$stmt->bindParam(':employee_hire_date', $this->emp_hire_date);
			$stmt->bindParam(':employee_status', $this->emp_status);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}

		} // function ends

		function updateEmployee($id)
		{
			$query = "UPDATE employee_account
						SET
							employee_id=:employee_id,
							employee_password=:employee_password,
							employee_fname=:employee_fname,
							employee_mname=:employee_mname,
							employee_lname=:employee_lname,
							employee_email=:employee_email,
							employee_contact=:employee_contact,
							employee_date_time_creation=:employee_date_time_creation,
							employee_position_title=:employee_position_title,
							employee_image=:employee_image,
							employee_hire_date=:employee_hire_date,
							employee_status=:employee_status
						WHERE employee_id = '$id'";

			$stmt = $this->conn->prepare($query);

			$this->emp_id = htmlspecialchars(strip_tags($this->emp_id));
			$this->emp_password = htmlspecialchars(strip_tags($this->emp_password));
			$this->emp_fname = htmlspecialchars(strip_tags($this->emp_fname));
			$this->emp_mname = htmlspecialchars(strip_tags($this->emp_mname));
			$this->emp_lname = htmlspecialchars(strip_tags($this->emp_lname));
			$this->emp_email = htmlspecialchars(strip_tags($this->emp_email));
			$this->emp_contact = htmlspecialchars(strip_tags($this->emp_contact));
			$this->emp_datetime = htmlspecialchars(strip_tags($this->emp_datetime));
			$this->emp_pos_title = htmlspecialchars(strip_tags($this->emp_pos_title));
			$this->emp_image = htmlspecialchars(strip_tags($this->emp_image));
			$this->emp_hire_date = htmlspecialchars(strip_tags($this->emp_hire_date));
			$this->emp_status = htmlspecialchars(strip_tags($this->emp_status));

			echo $stmt->bindParam(':employee_id', $this->emp_id);
			echo $stmt->bindParam(':employee_password', $this->emp_password);
			echo $stmt->bindParam(':employee_fname', $this->emp_fname);
			echo $stmt->bindParam(':employee_mname', $this->emp_mname);
			echo $stmt->bindParam(':employee_lname', $this->emp_lname);
			echo $stmt->bindParam(':employee_email', $this->emp_email);
			echo $stmt->bindParam(':employee_contact', $this->emp_contact);
			echo $stmt->bindParam(':employee_date_time_creation', $this->emp_datetime);
			$stmt->bindParam(':employee_position_title', $this->emp_pos_title);
			$stmt->bindParam(':employee_image', $this->emp_image);
			$stmt->bindParam(':employee_hire_date', $this->emp_hire_date);
			$stmt->bindParam(':employee_status', $this->emp_status);

			if($stmt->execute())
			{
				return $stmt;
			}
			else
			{
				return false;
			}

		} // function ends

		function viewSupervisor()
		{
			$query = "SELECT * FROM employee_account 
				WHERE 
					employee_position_title LIKE 'Supervisor'";

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

		function viewFrontliner()
		{
			$query = "SELECT * FROM employee_account 
				WHERE 
					employee_position_title LIKE 'Frontliner'";

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

		function loginEmployee()
		{
			$query = 'SELECT * FROM employee_account
						WHERE
							employee_id=:employee_id
							AND
							employee_password=:employee_password';

			$stmt = $this->conn->prepare($query);

			$this->emp_id = htmlspecialchars(strip_tags($this->emp_id));
			$this->emp_password = htmlspecialchars(strip_tags($this->emp_password));

			$stmt->bindParam(':employee_id', $this->emp_id);
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
