<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task.php';

	$conn = new Database();
	$Task = new Task($conn->databaseConnection());
  date_default_timezone_set("Asia/Manila");

	$Task->task_end_time = date('H:i:s');
	$Task->task_status = 'Completed';
	$Task->updateEndTimeTask($taskid);
?>

