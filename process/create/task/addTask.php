<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task.php';

	$conn = new Database();
	$Task = new Task($conn->databaseConnection());
	date_default_timezone_set("Asia/Manila");
	
	session_start();

	$Task->task_datetime = date('Y-m-d');
	$Task->task_type = $tid;
  $Task->task_client_id = $caseno;
  $Task->task_date_received = $datetime;
	$Task->task_start_time = date('H:i:s');
	$Task->task_hold_start_time = date('H:i:s');
	$Task->task_hold_end_time = date('H:i:s');
	$Task->task_end_time = date('H:i:s');
	$Task->task_status = 'Ongoing';
	$Task->task_employee_id = $_SESSION['id'];

	$Task->addTask();

?>
