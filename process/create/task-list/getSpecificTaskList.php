<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task-list.php';

	$conn = new Database();
	date_default_timezone_set('Asia/Manila');

	$TaskList = new TaskList($conn->databaseConnection());

	$result = $TaskList->getTaskListData($_POST['type']);
	if($result_data = $result->fetch(PDO::FETCH_ASSOC))
	{
		$task_title = $result_data['task_list_title'];
		$task_process_time = $result_data['task_list_process_time'];
		$task_sla = $result_data['task_list_sla'];
		$task_importance = $result_data['task_list_importance'];
	}
?>



