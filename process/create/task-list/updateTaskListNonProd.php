<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task-list.php';

	$conn = new Database();
	date_default_timezone_set('Asia/Manila');

	$TaskList = new TaskList($conn->databaseConnection());

	echo $TaskList->task_list_id = $_GET['tid'];
	echo $TaskList->task_list_title = $_GET['tname'];
	echo $TaskList->task_list_importance = $_GET['select'];
	
	// $TaskList->updateTaskListNonProd();
?>

