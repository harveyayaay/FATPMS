<?php

	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task-list.php';

	$conn = new Database();

	$TaskList = new TaskList($conn->databaseConnection());

	$TaskList->task_list_title = $title;
	$TaskList->task_list_process_time = $ptime;
	$TaskList->task_list_sla = $sla;
	$TaskList->task_list_importance = $level;
	
	$TaskList->updateTaskListProd($tid);
?>

