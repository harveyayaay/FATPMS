<?php
	include_once '../../config/database.php';
	include_once '../../obj/registration.php';

	$conn = new Database();
	$Employee = new Registration($conn->databaseConnection());

	$id = $_POST['empid'];
	$Employee->emp_id = $_POST['empid'];
	$Employee->emp_fname = $_POST['empfname'];
	$Employee->emp_mname = $_POST['empmname'];
	$Employee->emp_lname = $_POST['emplname'];
	$Employee->emp_hire_date = $_POST['emphire'];
	$Employee->emp_email = $_POST['empemail'];
	$Employee->emp_contact = $_POST['empcontact'];
	$Employee->emp_image = $_POST['empimg'];
	$Employee->emp_password = $_POST['emppass'];
	date_default_timezone_set('Asia/Manila');
	$Employee->emp_datetime = date('Y-d-m H:i:s');
	$Employee->emp_pos_title = $_POST['emppos'];
	$Employee->emp_status = $_POST['empstat'];

	if($Employee->updateEmployee($id))
	{
		header("location: ../../../render/manager/body/employee-management.php");
	}
	else
	{
		echo 'Unsuccessful';
	}

?>