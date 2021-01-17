<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/employee.php';

	$conn = new Database();
	$Employee = new employee($conn->databaseConnection());

	$Employee->emp_fname = $fname;
	$Employee->emp_lname = $lname;
	$Employee->emp_email = $email;
	$Employee->emp_contact = $contact;
	$Employee->emp_pos_title = $position;
	$Employee->emp_status = $status;

	$Employee->updateEmployee($id);
	
?>