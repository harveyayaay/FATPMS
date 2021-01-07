<?php

	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/task.php';

	$conn = new Database();

	$emp_id = $_SESSION['employee_id'];

	$Task = new Task($conn->databaseConnection());
	date_default_timezone_set('Asia/Manila');
	$ongoing = $Task->checkOngoingTask($emp_id);
	$ongoing_data = $ongoing->fetch( PDO::FETCH_ASSOC);
	if($ongoing_data['count'] == 0 )	
	{
		echo 'gago';
		include_once "activity-tracker/task-area-1-add.php";

		$onhold = $Task->checkOnholdTask($emp_id);
		$onhold_data = $onhold->fetch( PDO::FETCH_ASSOC);
		if($onhold_data['count'] > 0)
		{
			include_once "activity-tracker/task-area-3-continue.php";
		}

		$completed = $Task->checkCompletedTask($emp_id);
		$completed_data = $completed->fetch( PDO::FETCH_ASSOC);
		if($completed_data['count'] > 0)
		{
			include_once "activity-tracker/task-area-4-completed.php";
		}
	}
	else
	{
		include_once "activity-tracker/task-area-2-process.php";
	}
	
	

?>