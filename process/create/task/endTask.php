<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task.php';


	$conn = new Database();

	$Task = new Task($conn->databaseConnection());
	date_default_timezone_set('Asia/Manila');
	$employee_id = $_GET['emp_id'];

	$Task->task_status = 'Ended';
	$Task->task_employee_id = $employee_id;

	$Task->updateEndShift();
	header("location: ../../../render/frontliner/body/activity-tracker.php");
?>
