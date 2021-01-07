<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task.php';

	$conn = new Database();

	$Task = new Task($conn->databaseConnection());

	date_default_timezone_set('Asia/Manila');
	$date = date('2020-11-09');

	include '../../../../process/create/task-list/getProductiveTaskList.php';

	$p_count = 0;
	$p_seconds = 0;
	$duration_prod = '00:00:00';
	for($i=0;$i<$count_prod;++$i)
	{
		$result_duration = $Task->getProdDuration($date, $prod[$i], $empid);
		while($result_duration_data = $result_duration->fetch(PDO::FETCH_ASSOC))
		{
			$h = date('H', strtotime($result_duration_data['task_duration']));
			$m = date('i', strtotime($result_duration_data['task_duration']));
			$s = date('s', strtotime($result_duration_data['task_duration']));
			// echo $result_duration_data['task_duration'].' ';
			$duration_prod = date('H:i:s', strtotime("+".$h." hours +".$m." minutes +".$s." seconds", strtotime($duration_prod)));
			$p_seconds += $h * 3600;
			$p_seconds += $m * 60;
			$p_seconds += $s;
			// echo '<br>';
			++$p_count;
		}
		
	}	
	if($p_count > 0)
		$p_seconds /= $p_count;

	$apt = gmdate('H:i:s', $p_seconds);
?>