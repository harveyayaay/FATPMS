<?php

	include_once '../../config/database.php';
	include_once '../../obj/task.php';

	$conn = new Database();

	$Task = new Task($conn->databaseConnection());
	date_default_timezone_set('Asia/Manila');

	$Task->task_hold_end_time = date('H:i:s');
	$Task->task_end_time = date('H:i:s');
	$Task->task_status = 'Ongoing';

	$task_id = $_GET['id'];

	$Task->updateHoldEndTimeTask($task_id);
	
	header("location: ../../../render/frontliner/body/activity-tracker.php");

?>
