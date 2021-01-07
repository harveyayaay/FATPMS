<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task-list.php';

	$conn = new Database();

	$TaskList = new TaskList($conn->databaseConnection());
	$result_tasklist = $TaskList->getTaskListData($tid);
	if($result_tasklist_data = $result_tasklist->fetch(PDO::FETCH_ASSOC))
	{
		$task_title = $result_tasklist_data['task_list_title'];
		$task_process_time = $result_tasklist_data['task_list_process_time'];
		$task_sla = $result_tasklist_data['task_list_sla'];
		$task_importance = $result_tasklist_data['task_list_importance'];
	}
?>
