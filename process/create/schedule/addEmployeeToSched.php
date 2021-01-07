<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';

	$conn = new Database();

	$Sched = new Schedule($conn->databaseConnection());

	$Sched->schedule_id = $_POST['schedid'];
	$Sched->schedule_task_list_id = $_POST['taskid'];
	$Sched->schedule_time_from = $_POST['timefrom'];
	$Sched->schedule_time_to = $_POST['timeto'];

	$result = $Sched->addEmployeeToSched();
	$result_data = $result->fetch(PDO::FETCH_ASSOC);
		header("location: ../../../render/supervisor/body/scheduling.php");
?>