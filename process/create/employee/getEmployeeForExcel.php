<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/employee.php';

	$id = $empid = $_POST['empid'];
	$conn = new Database();

	$Employee = new Employee($conn->databaseConnection());

	$result = $Employee->getEmployee($empid);
	$result_data = $result->fetch(PDO::FETCH_ASSOC);
?>