<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';

	$conn = new Database();

	$Sched = new Schedule($conn->databaseConnection());

	$getDetails = $Sched->getEmployeeDetails($empid);

	while($getDetails_data = $getDetails ->fetch( PDO::FETCH_ASSOC))
	{
		$id = $getDetails_data['employee_id'];
		$fname = $getDetails_data['employee_fname'];
		$lname = $getDetails_data['employee_lname'];
	}
	


	

?>

