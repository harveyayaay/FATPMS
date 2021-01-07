<?php
	include_once '../../../../process/config/database.php';
	include_once '../../../../process/obj/task-list.php';

	$conn = new Database();

	$TaskList = new TaskList($conn->databaseConnection());

	date_default_timezone_set('Asia/Manila');
	$date = date('Y-m-d');
	
	$count_prod = 0;
	$result_list = $TaskList->getAllProdId();
	while($result_list_data = $result_list->fetch(PDO::FETCH_ASSOC))
	{
		$prod[$count_prod] = $result_list_data['task_list_id'];
		++$count_prod;
	}

?>