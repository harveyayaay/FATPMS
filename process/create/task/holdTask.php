<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task.php';

	$conn = new Database();
	$Task = new Task($conn->databaseConnection());
  date_default_timezone_set("Asia/Manila");


	$Task->task_hold_start_time = date('H:i:s');
	$Task->task_hold_end_time = date('H:i:s');
	$Task->task_end_time = date('H:i:s');
	$Task->task_status = 'On-hold';
	$Task->updateHoldStartTimeTask($taskid);
?>
