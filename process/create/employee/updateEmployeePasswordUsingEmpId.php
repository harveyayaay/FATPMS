<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/employee.php';

	$conn = new Database();

	$Employee = new Employee($conn->databaseConnection());

	$Employee->emp_password = $newpass;

	$result_emp = $Employee->updateEmployeePasswordUsingEmpId($empid, $newpass);
?>