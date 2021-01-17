<?php
	include_once '../../process/config/database.php';
	include_once '../../process/obj/employee.php';

  $conn = new Database();
  
	$Employee = new Employee($conn->databaseConnection());

	$result_notif = $Employee->countEmployeeUsingIdAndPassword($id, $pass);
?>