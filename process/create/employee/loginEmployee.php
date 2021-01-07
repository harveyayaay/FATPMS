<?php

	include_once '../../config/database.php';
	include_once '../../obj/registration.php';

	$conn = new Database();
	session_start();

	$loginEmployee = new Registration($conn->databaseConnection());

	if(isset($_POST["submit"]))
	{
		$loginEmployee->emp_id = $_POST["empno"];
		$loginEmployee->emp_password = $_POST["password"];
		
		$stmt = $loginEmployee->loginEmployee();
		
		$count = $stmt->rowCount();

		if($count <= 0)
		{
			header("location: ../../../render/login/login.php?error=1");
		}
		else
		{
			$data = $stmt->fetch(PDO::FETCH_ASSOC);

				
			$_SESSION['employee_id'] = $data['employee_id'];
			$_SESSION['employee_password'] = $data['employee_password'];
			$_SESSION['employee_fname'] = $data['employee_fname'];
			$_SESSION['employee_mname'] = $data['employee_mname'];
			$_SESSION['employee_lname'] = $data['employee_lname'];
			$_SESSION['employee_image'] = $data['employee_image'];
			$_SESSION['employee_email'] = $data['employee_email'];
			$_SESSION['employee_contact'] = $data['employee_contact'];
			$_SESSION['employee_position_title'] = $data['employee_position_title'];

			$position = $data['employee_position_title'];
			
			if($position === 'Frontliner')
			{
				header("location: ../../../render/frontliner/body/dashboard.php");
			}
			else if($position === 'Supervisor')
			{
				header("location: ../../../render/supervisor/body/dashboard.php");
			}
			else if($position === 'Manager')
			{
				header("location: ../../../render/manager/body/dashboard.php");
			}
		}
	}

?>