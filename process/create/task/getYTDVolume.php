<?php
	header('Content-Type: application/json');
	include_once '../../config/database.php';
	include_once '../../obj/task.php';
	include_once '../../obj/task-list.php';

	$conn = new Database();

	$TaskList = new TaskList($conn->databaseConnection());

	date_default_timezone_set('Asia/Manila');
	$date = date('2020-11-09');
	
	$count_prod = 0;
	$result_list = $TaskList->getAllProdId();
	while($result_list_data = $result_list->fetch(PDO::FETCH_ASSOC))
	{
		$prod[$count_prod] = $result_list_data['task_list_id'];
		++$count_prod;
	}

	// include_once '../../../../process/config/database.php';
	// include_once '../../../../process/obj/task.php';
	// include '../../../../process/create/task-list/getProductiveTaskList.php';

	$conn = new Database();

	$Task = new Task($conn->databaseConnection());

	date_default_timezone_set('Asia/Manila');
	$date = date('2020-11-09');

	$daymonth = date('Y-m', strtotime($date));

	$looped_date = date('Y-m-d', strtotime('-1 day '.$daymonth));
	$json_get_date = array();
	$json_get_volume = array();
	$json_get = array();
	while($looped_date != $date)
	{
		$looped_date = date('Y-m-d', strtotime('+1 day '.$looped_date));
		$volume = 0;	
		for($i=0;$i<$count_prod;++$i)
		{
			$result_task = $Task->getYTDVolume($looped_date, $prod[$i]);
			while($result_task_data = $result_task->fetch(PDO::FETCH_ASSOC))
			{
				$volume += $result_task_data['counted'];
			}
		}
		$date_fetched = date("F j", strtotime($looped_date));
		$json_get_date[] = $date_fetched;
		$json_get_volume[] = $volume;
		// array_push($json_get_volume, $volume);

	}
	// $data = array();
	// foreach ($result as $row) {
	// 	$data[] = $row;
	// }
	print_r($json_get_date);
	print_r($json_get_volume);
	echo json_encode($json_get_date);
	echo json_encode($json_get_volume);
?>

