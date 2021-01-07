<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task.php';

	$conn = new Database();

	$Task = new Task($conn->databaseConnection());

	$volume = 0;
	$result_task = $Task->countTaskUsingDateTypeAndEmpid($date, $tid, $empid);
	while($result_task_data = $result_task->fetch(PDO::FETCH_ASSOC))
	{
		$volume += $result_task_data['counted'];
	}
?>