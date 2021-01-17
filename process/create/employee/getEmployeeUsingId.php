<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/employee.php';

	$conn = new Database();

	$Employee = new Employee($conn->databaseConnection());

	$result_emp = $Employee->getEmployeeUsingId($id);

?>