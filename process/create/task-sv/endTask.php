<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task.php';


	$conn = new Database();
	date_default_timezone_set('Asia/Manila');
	$Task = new Task($conn->databaseConnection());

	$employee_id = $_GET['emp_id'];

	$Task->task_status = 'Ended';
	$Task->task_employee_id = $employee_id;

	$Task->updateEndShift();
	header("location: ../../../render/supervisor/body/activity-monitoring.php");
?>
