<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task.php';

	$conn = new Database();
	date_default_timezone_set('Asia/Manila');

	$Task = new Task($conn->databaseConnection());

	$result_task = $Task->getTaskUsingDateAndType($date, $tid);
?>

