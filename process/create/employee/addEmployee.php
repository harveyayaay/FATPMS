<?php
	include_once '../../config/database.php';
	include_once '../../obj/registration.php';

	$conn = new Database();

	$addEmployee = new Registration($conn->databaseConnection());

	$addEmployee->emp_id = $_POST['empid'];
	$addEmployee->emp_password = $_POST['emppass'];
	$addEmployee->emp_fname = $_POST['empfname'];
	$addEmployee->emp_mname = $_POST['empmname'];
	$addEmployee->emp_lname = $_POST['emplname'];
	$addEmployee->emp_hire_date = $_POST['emphire'];
	$addEmployee->emp_email = $_POST['empemail'];
	$addEmployee->emp_contact = $_POST['empcontact'];
	$addEmployee->emp_image = 'default.jpg';
	date_default_timezone_set('Asia/Manila');
	$addEmployee->emp_datetime = date('Y-d-m H:i:s');
	$addEmployee->emp_pos_title = $_POST['emppos'];
	$addEmployee->emp_status = 'Active';

	$addEmployee->addEmployee();
	header('location: ../../../render/manager/body/employee-management.php');
?>