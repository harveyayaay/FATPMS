<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task.php';
	include '../../../../process/create/task-list/getProductiveTaskList.php';

	$conn = new Database();

	$Task = new Task($conn->databaseConnection());

	date_default_timezone_set('Asia/Manila');
	$date = date('2020-11-09');

	$volume = 0;
	for($i=0;$i<$count_prod;++$i)
	{
		$result_task = $Task->countTask($date, $prod[$i], $empid);
		while($result_task_data = $result_task->fetch(PDO::FETCH_ASSOC))
		{
			$volume += $result_task_data['counted'];
		}
	}
?>