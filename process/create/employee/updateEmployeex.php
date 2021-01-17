<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/employee.php';

	$conn = new Database();

	$Employee = new Employee($conn->databaseConnection());

	$Employee->emp_fname = $fname;
	$Employee->emp_mname = $mname;
	$Employee->emp_lname = $lname;
	$Employee->emp_email = $email;
	$Employee->emp_contact = $contact;

	$result_emp = $Employee->updateEmployee($id);
?>