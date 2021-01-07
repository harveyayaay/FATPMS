<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task.php';

	$conn = new Database();

	$Task = new Task($conn->databaseConnection());

	$volume = 0;
	$result_count_task = $Task->countTaskUsingDatesAndType($tid, $date1, $date2);
?>