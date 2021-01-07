<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task-list.php';

	$conn = new Database();
	date_default_timezone_set('Asia/Manila');

	$TaskList = new TaskList($conn->databaseConnection());

	$result = $TaskList->countTaskListImportance($_POST['taskimp']);
	$result_data = $result->fetch(PDO::FETCH_ASSOC);
	$count = $result_data['COUNT'] + 1;

	if($_POST['taskimp'] === 'Primary')
	{
		$TaskList->task_list_id = 'P'.$count;
		$TaskList->task_list_title = $_POST['tasktitle'];
		$TaskList->task_list_process_time = $_POST['taskptime'];
		$TaskList->task_list_sla = $_POST['taskweight'];
		$TaskList->task_list_importance = $_POST['taskimp'];
	}
	else if($_POST['taskimp'] === 'Secondary')
	{
		$TaskList->task_list_id = 'S'.$count;
		$TaskList->task_list_title = $_POST['tasktitle'];
		$TaskList->task_list_process_time = $_POST['taskptime'];
		$TaskList->task_list_sla = $_POST['taskweight'];
		$TaskList->task_list_importance = $_POST['taskimp'];
	}
	else
	{
		$TaskList->task_list_id = 'NP'.$count;
		$TaskList->task_list_title = $_POST['tasktitle'];
		$TaskList->task_list_process_time = '';
		$TaskList->task_list_sla = '';
		$TaskList->task_list_importance = $_POST['taskimp'];
	}

	$TaskList->addTaskList();
?>

