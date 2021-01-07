<?php
	session_start();
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task.php';

	$conn = new Database();

	$Task = new Task($conn->databaseConnection());
	date_default_timezone_set('Asia/Manila');

	$Task->task_datetime = date('Y-m-d');
	$Task->task_type = $_GET['task_type'];
	$Task->task_client_id = $_GET['task_client_id'];
	$Task->task_date_received = $_GET['task_date_received'];
	$Task->task_start_time = date('H:i:s');
	$Task->task_hold_start_time = date('H:i:s');
	$Task->task_hold_end_time = date('H:i:s');
	$Task->task_end_time = date('H:i:s');
	$Task->task_employee_id = $_SESSION['employee_id'];
	$Task->task_status = 'Ongoing';

	$Task->storeInitialTask();

	header("location: ../../../render/supervisor/body/activity-monitoring.php");

?>
