<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task-list.php';

	$conn = new Database();
	date_default_timezone_set('Asia/Manila');

	$TaskList = new TaskList($conn->databaseConnection());

	$result_task = $TaskList->getTaskListUsingId($tid);

?>